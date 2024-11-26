<?php 
namespace App\Services;

use App\Models\Voucher;
use App\Repositories\CustomerVoucherRepository;
use Illuminate\View\View;

class CustomerVoucherService
{
    const STATUS_ACTIVE = 1;
    protected $customerVoucherRepository;
    public function __construct(CustomerVoucherRepository $customerVoucherRepository)
    {
        $this->customerVoucherRepository = $customerVoucherRepository;
    }

    public function create($data)
    {
        return $this->customerVoucherRepository->create($data);
    }

    public function getAll()
    {
        return $this->customerVoucherRepository->getAll();
    }

    public function getByCustomer($customerId)
    {
        $status = self::STATUS_ACTIVE;
        return $this->customerVoucherRepository->getByCustomer($customerId,$status);
    }

    public function getByCustomerAndVoucher($customerId, $voucherId)
    {
        return $this->customerVoucherRepository->getByCustomerAndVoucher($customerId, $voucherId);
    }

    public function getByStatusUsed($customerId, $voucherId, $status) {
        return $this->customerVoucherRepository->getByStatusUsed($customerId, $voucherId, $status);
    }
}