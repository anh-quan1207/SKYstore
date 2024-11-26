<?php
namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;

class OrderRepository
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function create(array $data)
    {
        return $this->order->create($data);
    }

    public function update($order, $status)
    {
        return $order->update(['status' => $status]);
    }

    public function getById($id)
    {
        return $this->order->find($id);
    }

    public function getByIdWithOrderLine($id)
    {
        return $this->order->with('orderLines')->find($id);
    }
    public function getAllPaginate()
    {
        return $this->order->with('orderLines')
            ->orderBy("created_at", "desc")
            ->paginate(30);
    }

    public function getByCustomer($customerId)
    {
        return $this->order->with('orderLines')->where('customer_id', $customerId)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function countOrderByCustomer($customerId, $statusSucces)
    {
        return $this->order->where(['customer_id' => $customerId, 'status' => $statusSucces])->count();
    }

    public function countByDate($statusSucces)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        return $this->order->where('status', $statusSucces)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();
    }

    public function getTotalAmountByDate($statusSucces)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        return $this->order->where('status', $statusSucces)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->pluck('total_amount')->toArray();
    }

    public function totalRevenueByMonth($yearNow, $monthNow, $status)
    {
        return $this->order::whereYear("created_at", $yearNow)->whereMonth("created_at", $monthNow)
            ->where('status', $status)->sum('total_amount');
    }

    public function countOrderByMonth($yearNow, $monthNow, $status)
    {
        return $this->order::whereYear("created_at", $yearNow)
            ->whereMonth("created_at", $monthNow)
            ->where('status', $status)
            ->count();
    }

    public function totalRevenueByYear($yearNow, $status)
    {
        return $this->order::whereYear("created_at", $yearNow)
            ->where('status', $status)->sum('total_amount');
    }

    public function countOrderByYear($yearNow, $status)
    {
        return $this->order::whereYear("created_at", $yearNow)
            ->where('status', $status)
            ->count();
    }
}