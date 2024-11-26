<?php
namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\CustomerVoucherRepository;
use App\Repositories\OrderLineRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PayRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayService 
{
    const STATUS_USED = 3;
    const STATUS_PENDDING = 1;
    protected $payRepsitory;
    protected $orderRepository;
    protected $orderLineRepository;
    protected $cartRepository;
    protected $productVariantRepository;
    protected $customerVoucherRepository;
    public function __construct(PayRepository $payRepository,
    OrderLineRepository $orderLineRepository,
    OrderRepository $orderRepository,
    CartRepository $cartRepository,
    ProductVariantRepository $productVariantRepository,
    CustomerVoucherRepository $customerVoucherRepository,
    )
    {
        $this->payRepsitory = $payRepository;
        $this->orderRepository = $orderRepository;
        $this->orderLineRepository = $orderLineRepository;
        $this->cartRepository = $cartRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->customerVoucherRepository = $customerVoucherRepository;
    }

    public function create(array $data)
    {
        return $this->payRepsitory->create($data);
    }

    public function payByCart($dataPay, $voucher)
    {
        try {
            DB::transaction(function () use ($dataPay, $voucher) {
                $this->processOrderByCart($dataPay, $voucher);
            });
            $result = [
                $message = "Đặt hàng thành công",
                $status = 'success',
            ];
            session()->forget('carts');
            return redirect()->route('home_page_user')->with('result', $result);
        } catch (\Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            return redirect()->route('user-cart')->with('result', $result);
        } finally {
            $this->forgetSessionWhenPaymentOnline();
        }
    }

    public function payByProductDetail($dataPay, $voucher)
    {
        try {
            DB::transaction(function () use ($dataPay, $voucher) {
                $this->processOrderByProductDetail($dataPay, $voucher);
            });
            $result = [
                $message = "Đặt hàng thành công",
                $status = 'success',
            ];
            session()->forget('productVariantId');
            session()->forget('buyQuantity');
            return redirect()->route('home_page_user')->with('result', $result);
        } catch (\Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            $productVariantId = session()->get('productVariantId');
            $productVariant = $this->productVariantRepository->getById($productVariantId);
            $productId = $productVariant->product->id;
            return redirect()->route('product-detail', ['id' => $productId])->with('result', $result);
        } finally {
            $this->forgetSessionWhenPaymentOnline();
        }
    }

    private function processOrderByCart($dataPay,$voucher)
    {
        $carts = session()->get('carts');
        if($carts->isEmpty() || empty($carts))
        {
            throw new \Exception('Giỏ hàng trống');
        }
        $order = $this->createOrder($voucher);
        $totalAmount = 0;
        foreach($carts as $cart)
        {
            $priceOrderLine = $this->createOrderLineByCart($cart, $order);
            $totalAmount += $priceOrderLine;
            $this->cartRepository->delete($cart->id);
        }
        $this->updateTotalAmountOrder($order, $totalAmount,$voucher);
        if(!is_null($voucher)) {
            $this->updateRemainQuantityVoucher($voucher);
            $this->handleCustomerVoucher($voucher);
        }
        $this->createPay($dataPay, $order->id);
    }


    private function createOrder($voucher){
        $dataOrder['customer_id'] = Auth::user()->id;
        $dataOrder['order_code'] = $this->getOrderCode();
        $dataOrder['total_amount'] = is_null($voucher) ? 0 : 1;
        $dataOrder['status'] = self::STATUS_PENDDING;
        $dataOrder['discount'] = 0;

        return $this->orderRepository->create($dataOrder);
    }

    private function getOrderCode(): string
    {
        $characterTexts = range('A', 'Z');
        $characterNumbers = range(0, 9);
        $orderCodeGenerationText = '';
        $orderCodeGenerationNumber = '';
        for ($i = 0; $i < 2; $i++) {
            $randomKey = array_rand($characterTexts);
            $orderCodeGenerationText .= $characterTexts[$randomKey];
        }

        $orderCodeGeneration = '';
        for ($i = 0; $i < 4; $i++) {
            $randomKey = array_rand($characterNumbers);
            $orderCodeGenerationNumber .= $characterNumbers[$randomKey];
        }

        $orderCodeGeneration = $orderCodeGenerationText .  date('dmy') . $orderCodeGenerationNumber ;
        return $orderCodeGeneration;
    }

    private function createOrderLineByCart($cart, $order)
    {
        $priceOrderLine = 0;
        $originPrice = priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount);
        if ($originPrice !== $cart->price) {
            throw new \Exception("Giá sản phẩm đã thay đổi, vui lòng đặt hàng lại");
        }

        if ($cart->quantity > $cart->productVariant->remain_quantity) {
            throw new \Exception("Đặt hàng thất bại, không đủ số lượng sản phẩm");
        }

        $dataOrderLine['order_id'] = $order->id;
        $dataOrderLine['product_variant_id'] = $cart->productVariant->id;
        $dataOrderLine['quantity'] = $cart->quantity;
        $dataOrderLine['price'] = $cart->price;

        $orderLineInsert = $this->orderLineRepository->create($dataOrderLine);
        $priceOrderLine = $originPrice;
        $this->updateQuantityProduct($cart->productVariant->product,$dataOrderLine['quantity']);
        $this->updateQuantityProductVariant($cart->productVariant, $dataOrderLine['quantity']);

        return $priceOrderLine;
    }

    private function createPay($dataPay,$orderId)
    {
        $dataPay['order_id'] = $orderId;
        return $this->create($dataPay);
    }

    private function updateQuantityProduct($product,$quantity)
    {
        $product->sold_quantity += $quantity;
        $product->remain_quantity -= $quantity;
        $product->save();
    }

    private function updateQuantityProductVariant($productVariant, $quantity)
    {
        $productVariant->sold_quantity += $quantity;
        $productVariant->remain_quantity -= $quantity;
        $productVariant->save();
    }

    private function updateTotalAmountOrder($order, $totalAmount, $voucher)
    {
        $voucherValue = is_null($voucher) ? 0 : $voucher->value;
        if($voucherValue != 0) {
            $order->discount = (int)round($totalAmount * $voucherValue / 100 );
        }
        $totalAmount -= (int)round($totalAmount * $voucherValue / 100 );
        $order->total_amount = $totalAmount;
        $order->save();
    }

    private function updateRemainQuantityVoucher($voucher)
    {
        $voucher->remain_quantity -= 1;
        $voucher->save();
    }

    private function handleCustomerVoucher($voucher) {
        $customerId = Auth::user()->id;
        $voucherId = $voucher->id;
        $customerVoucher = $this->customerVoucherRepository->getByCustomerAndVoucher($customerId, $voucherId);
         if(!is_null($customerVoucher)) {
            $this->updateStatusCustomerVoucher($customerVoucher);
         }
         else {
            $this->createCustomerVoucher($voucherId, $customerId);
         }
    }

    private function updateStatusCustomerVoucher($customerVoucher)
    {
            $customerVoucher->status = self::STATUS_USED;
            $customerVoucher->save();
    }

    private function createCustomerVoucher($voucherId, $customerId) 
    {
        $data['voucher_id'] = $voucherId;
        $data['customer_id'] = $customerId;
        $data['status'] = self::STATUS_USED;

        $this->customerVoucherRepository->create($data);
    }

    private function processOrderByProductDetail($dataPay,$voucher)
    {
        $productVariantId = session()->get('productVariantId');
        $buyQuantity = session()->get('buyQuantity');
        $productVariant = $this->productVariantRepository->getById($productVariantId);
        if(is_null($productVariant))
        {
            throw new \Exception('Sản phẩm không tồn tại');
        }
        $order = $this->createOrder($voucher);
        $this->createOrderLine($productVariant,$buyQuantity, $order);
        $totalAmount = priceDiscount($productVariant->product->price,$productVariant->product->discount) * $buyQuantity;
        $this->updateTotalAmountOrder($order, $totalAmount,$voucher);
        if(!is_null($voucher)) {
            $this->updateRemainQuantityVoucher($voucher);
            $this->handleCustomerVoucher($voucher);
        }
        $this->createPay($dataPay, $order->id);
    }

    private function createOrderLine($productVariant,$buyQuantity, $order)
    {
        $originPrice = priceDiscount($productVariant->product->price,$productVariant->product->discount);
        if ($buyQuantity > $productVariant->remain_quantity) {
            throw new \Exception("Đặt hàng thất bại, không đủ số lượng sản phẩm");
        }

        $dataOrderLine['order_id'] = $order->id;
        $dataOrderLine['product_variant_id'] = $productVariant->id;
        $dataOrderLine['quantity'] = $buyQuantity;
        $dataOrderLine['price'] = $originPrice;

        $orderLineInsert = $this->orderLineRepository->create($dataOrderLine);
        $this->updateQuantityProduct($productVariant->product,$dataOrderLine['quantity']);
        $this->updateQuantityProductVariant($productVariant, $dataOrderLine['quantity']);
        return $orderLineInsert;
    }

    private function forgetSessionWhenPaymentOnline()
    {
        session()->forget('type');
        session()->forget('data_to_create_order');
        session()->forget('voucher_to_create_order');
        session()->forget('vnp_ResponseCode');
    }
}