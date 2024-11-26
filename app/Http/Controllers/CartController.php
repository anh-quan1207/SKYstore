<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $productVariantService;
    protected $cartService;
    public function __construct(ProductVariantService $productVariantService,
    CartService $cartService,
    )
    {
        $this->productVariantService = $productVariantService;
        $this->cartService = $cartService;

    }
    public function addToCart(Request $request)
    {
        $data['customer_id'] = Auth::user()->id;
        $data['product_variant_id'] = $request->input('productVariantId');
        $data['quantity'] = $request->input('quantity');
        $productVariant = $this->productVariantService->getById($data['product_variant_id']);
        if (is_null($productVariant)) {
            return redirect()->route('error-404');
        }
        $data['price'] = priceDiscount($productVariant->product->price, $productVariant->product->discount);
        $cartExists = $this->cartService->getByProductVariantAndCustomer($data['product_variant_id'],$data['customer_id']);
        if(!is_null($cartExists)){
            $dataUpdate['quantity'] = $data['quantity'] + $cartExists->quantity;
            if($dataUpdate['quantity'] > $cartExists->productVariant->remain_quantity)
            {
                $result = [
                $message = "Giỏ hàng đã vượt quá số lượng",
                $status = 'error',
                ];
                return redirect()->back()->with('result',$result);
            }
            $dataUpdate['total_amount'] = priceDiscount($productVariant->product->price, $productVariant->product->discount) * $dataUpdate['quantity'];
            $updateCart = $this->cartService->update($dataUpdate,$cartExists);
            if ($updateCart) {
                $result = [
                    $message = "Thêm giỏ hàng thành công",
                    $status = 'success',
                ];
                return redirect()->route('product-detail',['id' => $productVariant->product->id])->with('result',$result);
            }
            else {
                $result = [
                    $message = "Thêm giỏ hàng thất bại",
                    $status = 'error',
                ];
                return redirect()->route('product-detail',['id' => $productVariant->product->id])->with('result',$result);
            }
        }
        
        $data['total_amount'] = priceDiscount($productVariant->product->price, $productVariant->product->discount) * $data['quantity'];
        $createCart = $this->cartService->create($data);
        if ($createCart) {
            $result = [
                $message = "Thêm giỏ hàng thành công",
                $status = 'success',
            ];
            return redirect()->route('product-detail',['id' => $productVariant->product->id])->with('result',$result);
        }
        else {
            $result = [
                $message = "Thêm giỏ hàng thất bại",
                $status = 'error',
            ];
            return redirect()->route('product-detail',['id' => $productVariant->product->id])->with('result',$result);
        }
    }

    public function handleCheckoutByCart(Request $request)
    {
        $cartIdString = $request->input('cartIds');
        $cartIds = explode(',', $cartIdString);
        $carts = $this->cartService->getByIds($cartIds);
        if($carts->isEmpty())
        {
            return redirect()->route('error-404');
        }
        session()->put('carts',$carts);
        return redirect()->route('user-pay-by-cart');
    }

    public function delete($id)
    {
        $cart = $this->cartService->delete($id);
        if ($cart) {
            $result = [
                $message = "Xóa sản phẩm giỏ hàng thành công",
                $status = 'success',
            ];
            return redirect()->route('user-cart')->with('result',$result);
        }
        else {
            $result = [
                $message = "Xóa sản phẩm giỏ hàng thất bại",
                $status = 'error',
            ];
            return redirect()->route('user-cart')->with('result',$result);
        }
    }
}