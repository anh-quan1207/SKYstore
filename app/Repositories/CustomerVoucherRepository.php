<?php
namespace App\Repositories;

use App\Models\CustomerVoucher;

class CustomerVoucherRepository 
{
    protected $customerVoucher;
    public function __construct(CustomerVoucher $customerVoucher)
    {
        $this->customerVoucher = $customerVoucher;
    }

    public function create($data)
    {
        return $this->customerVoucher->create($data);
    }

    public function getAll()
    {
        return $this->customerVoucher->get();
    }

    public function getByCustomer($customerId, $statusActive)
    {
        return $this->customerVoucher->where(['customer_id' => $customerId, 'status' => $statusActive])->get();
    }

    public function getByCustomerAndVoucher($customerId, $voucherId)
    {
        return $this->customerVoucher->where(['customer_id' => $customerId, 'voucher_id' => $voucherId])->first();
    }

    public function getByStatusUsed($customerId, $voucherId, $status) {
        return $this->customerVoucher->where(['customer_id' => $customerId, 'voucher_id' => $voucherId, 'status' => $status])->first();
    }
}