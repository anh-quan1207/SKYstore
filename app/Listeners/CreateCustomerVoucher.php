<?php

namespace App\Listeners;

use App\Events\VoucherCreated;
use App\Services\CustomerService;
use App\Services\CustomerVoucherService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCustomerVoucher
{
    /**
     * Create the event listener.
     */
    const STATUS_ACTIVE = 1;
    protected $customerService;
    protected $customerVoucherService;
    public function __construct(CustomerService $customerService, 
    CustomerVoucherService $customerVoucherService)
    {
        $this->customerService = $customerService;
        $this->customerVoucherService = $customerVoucherService;
    }

    /**
     * Handle the event.
     */
    public function handle(VoucherCreated $event): void
    {
        $voucher = $event->voucher;
        $customers = $this->customerService->getTopCustomersByOrderCount($voucher->quantity);
        foreach($customers as $customer)
        {
            $data['customer_id'] = $customer->id;
            $data['voucher_id'] = $voucher->id;
            $data['status'] = $this::STATUS_ACTIVE;
            $this->customerVoucherService->create($data);
        }
    }
}