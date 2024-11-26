<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherRequest;
use App\Services\VoucherService;
use Illuminate\Support\Str;
class VoucherController extends Controller
{
    protected $voucherService;
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    public function index()
    {
        $voucherTypeArray = config('variant.voucher_type');
        $vouchers = $this->voucherService->getAll();
        return view('admin.voucher.list-voucher',['vouchers' => $vouchers, 'increment' => 0, 'voucherTypeArray' => $voucherTypeArray]);
    }

    public function create()
    {
        $voucherTypeArray = config('variant.voucher_type');
        unset($voucherTypeArray[1]);
        return view('admin.voucher.form-create',['voucherTypeArray' => $voucherTypeArray]);
    }

    public function store(CreateVoucherRequest $request)
    {
        $data['title'] =  Str::upper($request->input('title'));
        $data['quantity'] = $request->input('quantity');
        $data['value'] = $request->input('value');
        $data['voucher_type'] = $request->input('voucher_type');
        $data['remain_quantity'] = $data['quantity'];
        $data['voucher_code'] = $this->getVoucherCode();
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');
        
        $createVoucher = $this->voucherService->create($data);
        if($createVoucher) {
             $result = [
                $message = "Tạo voucher thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-voucher-list')->with('result', $result);
        }
        else {  
            $result = [
                 $message = "Tạo voucher thất bại",
                 $status = 'error',
             ];
             return redirect()->route('admin-voucher-list')->with('result', $result);
        }
    }

    private function getVoucherCode()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = substr(str_shuffle($letters), 0, 2);
        $currentDate = date('dmy');
        $voucherCode = $randomLetters . $currentDate;
        return $voucherCode;
    }

    public function delete($id)
    {
        $voucher = $this->voucherService->getById($id);
        if(is_null($voucher)) {
            return redirect()->route('error-404');
        }

        $resultDelete = $this->voucherService->delete($voucher);
        if($resultDelete) {
            $result = [
                $message = "Xóa voucher thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-voucher-list')->with('result', $result);
        } else {
            $result = [
                $message = "Xóa voucher thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-voucher-list')->with('result', $result);
        }
    }
}