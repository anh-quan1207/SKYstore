<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    const ORDER_STATUS_PEDDING = 1;
    const ORDER_STATUS_PAID = 2;
    const ORDER_STATUS_SHIPPING = 3;
    const ORDER_STATUS_CANCLE = 6;
    const ORDER_STATUS_RECEIVED = 4;
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function update($order, $status)
    {
        if ($order->status == self::ORDER_STATUS_PEDDING) {
            $status = self::ORDER_STATUS_PAID;
        }

        if ($order->status == self::ORDER_STATUS_PAID) {
            $status = self::ORDER_STATUS_SHIPPING;
        }

        return $this->orderRepository->update($order, $status);
    }

    public function getById($id)
    {
        return $this->orderRepository->getById($id);
    }

    public function getByIdWithOrderLine($id)
    {
        return $this->orderRepository->getByIdWithOrderLine($id);
    }

    public function getAllPaginate()
    {
        return $this->orderRepository->getAllPaginate();
    }

    public function getByCustomer($customerId)
    {
        return $this->orderRepository->getByCustomer($customerId);
    }

    public function cancleOrder($order)
    {
        try {
            DB::transaction(function () use ($order) {
                $this->processUpdateStatusOrder(order: $order);
                $this->updateQuantity($order);
            });
            $result = [
                $message = "Hủy đơn hàng thành công",
                $status = 'success',
            ];
            return redirect()->route('order-history')->with('result',$result);
        } catch (Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            return redirect()->route('order-history')->with('result',$result);
        }
    }

    private function processUpdateStatusOrder($order)
    {
        if($order->status != self::ORDER_STATUS_PEDDING) 
        {
            throw new Exception('Trạng thái đơn hàng đã thay đổi, vui lòng thực hiện lại !');
        }
        else {
            $order->status = self::ORDER_STATUS_CANCLE;
            $order->save();
        }
    }

    private function updateQuantity($order)
    {
        $orderLines = $order->orderLines;
        if (!$orderLines->isEmpty()) {
            foreach ($orderLines as $orderLine) {
                $productVariant = $orderLine->productVariantWithTrashed;
                $product = $productVariant->product;
                if (!is_null($productVariant)) {
                    $productVariant->remain_quantity += 1;
                    $productVariant->sold_quantity -= 1;
                    $productVariant->save();
                }

                if (!is_null($product)) {
                    $product->remain_quantity += 1;
                    $product->sold_quantity -= 1;
                    $product->save();
                }
            }
        }
    }

    public function receiveOrder($order)
    {
        try {
            DB::transaction(function () use ($order) {
                $this->processUpdateStatusShippedOrder(order: $order);
            });
            $result = [
                $message = " đơn hàng thành công",
                $status = 'success',
            ];
            return redirect()->route('order-history');
        } catch (Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            return redirect()->route('order-history');
        }
    }

    private function processUpdateStatusShippedOrder($order)
    {
            $order->status = self::ORDER_STATUS_RECEIVED;
            $order->save();
    }

    public function countOrderByCustomer($customerId)
    {
        return $this->orderRepository->countOrderByCustomer($customerId, self::ORDER_STATUS_RECEIVED);
    }

    public function countByDate()
    {
        return $this->orderRepository->countByDate(self::ORDER_STATUS_RECEIVED);
    }

    public function getTotalAmountByDate()
    {
        return $this->orderRepository->getTotalAmountByDate(self::ORDER_STATUS_RECEIVED);
    }

    public function totalRevenueByMonth($yearNow, $monthNow, $status)
    {
        return $this->orderRepository->totalRevenueByMonth($yearNow, $monthNow, $status);
    }

    public function countOrderByMonth($yearNow, $monthNow, $status)
    {
        return $this->orderRepository->countOrderByMonth($yearNow, $monthNow, $status);
    }

    public function totalRevenueByYear($yearNow, $status)
    {
        return $this->orderRepository->totalRevenueByYear($yearNow, $status);
    }

    public function countOrderByYear($yearNow, $status)
    {
        return $this->orderRepository->countOrderByYear($yearNow, $status);
    }
}