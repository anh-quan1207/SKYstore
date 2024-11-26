<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|max:255',
            'customer_phone' => [
                'required',
                'regex:/^(0|\+84)[0-9]{9}$/',
            ],
            'payments' => 'required|in:1,2',
            'province' => 'required|not_in:0',
            'district' => 'required|not_in:0',
            'ward' => 'required|not_in:0',
            'voucher' => 'max:255',
            'address_detail' => 'required|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            "customer_name.required" => "Họ và tên không được để trống !",
            "customer_name.max" => "Họ và tên không vượt quá 255 ký tự !",
            "customer_phone.required" => "Số điện thoại không được để trống !",
            "customer_phone.regex" => "Số điện thoại không hợp lệ !",
            "payments.required" => "Hình thức thanh toán không được để trống !",
            "payments.in" => "Dữ liệu không hợp lệ !",
            "province.required" => "Tỉnh/Thành phố không được để trống !",
            'province.not_in' => 'Tỉnh/Thành phố không được để trống !',
            "district.required" => "Quận/Huyện  không được để trống !",
            'district.not_in' => 'Quận/Huyện  không được để trống !',
            "ward.required" => "Phường/Xã  không được để trống !",
            'ward.not_in' => 'Phường/Xã  không được để trống !',
            "voucher.max" => "Mã giảm giá không vượt quá 255 ký tự !",
            "address_detail.required" => "Địa chỉ cụ thể không được để trống !",
            "address_detail.max" => "Địa chỉ cụ thể không vượt quá 255 ký tự !",
        ];
    }
}
