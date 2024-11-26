<?php 
namespace App\Services;

use App\Events\VoucherCreated;
use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VoucherService
{
    const TYPE_HOLIDAY = 3;
    const TYPE_ONLINE_PAYMENT = 4;
    protected $voucherRepository;
    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    public function create($data)
    {
        $voucherCreate = $this->voucherRepository->create($data);
        if($data['voucher_type'] == 2) {
            event(new VoucherCreated( $voucherCreate));
        }
        return $voucherCreate;
    }

    public function delete($voucher)
    {
        DB::beginTransaction();
        try {
            $result = $this->voucherRepository->delete($voucher);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function getAll()
    {
        return $this->voucherRepository->getAll();
    }

    public function getById($id)
    {
        return $this->voucherRepository->getById($id);
    }

    public function getByVoucherCode($voucherCode)
    {
        return $this->voucherRepository->getByVoucherCode($voucherCode);
    }

    public function getByVoucherType()
    {
        $type3 = self::TYPE_HOLIDAY;
        $type4 = self::TYPE_ONLINE_PAYMENT;
        $today = Carbon::today();
        return $this->voucherRepository->getByVoucherType($type3, $type4, $today);
    }

    public function getByVoucherCodeCondition($voucherCode)
    {
        return $this->voucherRepository->getByVoucherCodeCondition($voucherCode);
    }
}