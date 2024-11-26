<?php
namespace App\Repositories;

use App\Models\Voucher;
use Carbon\Carbon;

class VoucherRepository 
{
    protected $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function create($data)
    {
        return $this->voucher->create($data);
    }

    public function delete($voucher)
    {
        return $voucher->delete();
    }

    public function getAll()
    {
        return $this->voucher->paginate(30);
    }

    public function getById($id)
    {
        return $this->voucher->find($id);
    }

    public function getByVoucherCode($voucherCode)
    {
        return $this->voucher->where('voucher_code')->first();
    }

    public function getByVoucherType($type3, $type4, $today)
    {
        return $this->voucher
        ->where(function($query) use ($type3, $type4) {
            $query->where('voucher_type', $type3)
                  ->orWhere('voucher_type', $type4);
        })
        ->whereDate('end_date', '>=', $today) 
        ->where('remain_quantity', '>', 0)
        ->orderBy('start_date', 'asc')
        ->get();
    }

    public function getByVoucherCodeCondition($voucherCode)
    {
        $today = Carbon::today();
        return $this->voucher
            ->where('voucher_code', $voucherCode)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->where('remain_quantity', '>', 0)
            ->first();
    }
}