<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVoucherRequest extends FormRequest
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
        $voucherTypeArray = config('variant.voucher_type');
        unset($voucherTypeArray[1]);
        $voucherTypeKeys = array_keys($voucherTypeArray);
        return [
            "title" => "bail|required|max:255",
            "quantity" => "bail|required|numeric|max:1000000",
            "value" => "bail|numeric|min:0|max:99.99",
            "voucher_type" => [
                "bail",
                "required",
                "numeric",
                Rule::in($voucherTypeKeys),
            ],
            "start_date" => "bail|required|date|before:end_date|after_or_equal:today",
            "end_date" => "bail|required|date|after:start_date",
        ];
    }

    public function messages() : array 
    {
        return [
            'title.required' => 'Tiêu đề không được để trống !',
            'title.max' => 'Dữ liệu không hợp lệ !',
            'quantity.required' => 'Số lượng không được để trống !',
            'quantity.numeric' => 'Dữ liệu không hợp lệ !',
            'quantity.max' => 'Dữ liệu không hợp lệ !',
            'value.numeric' => 'Dữ liệu không hợp lệ !',
            'value.min' => 'Dữ liệu không hợp lệ !',
            'value.max' => 'Dữ liệu không hợp lệ !',
            'voucher_type.required' => 'Loại voucher không được để trống !',
            'voucher_type.numeric' => 'Dữ liệu không hợp lệ !',
            'voucher_type.in' => 'Dữ liệu không hợp lệ !',
            'start_date.required' => 'Ngày bắt đầu không được để trống !',
            'start_date.date' => 'Dữ liệu không hợp lệ !',
            'start_date.after_or_equal' => 'Dữ liệu không hợp lệ !',
            'start_date.before' => 'Dữ liệu không hợp lệ !',
            'end_date.required' => 'Ngày kết thúc không được để trống !',
            'end_date.date' => 'Dữ liệu không hợp lệ !',
            'end_date.after' => 'Dữ liệu không hợp lệ !',
        ];
    }
}
