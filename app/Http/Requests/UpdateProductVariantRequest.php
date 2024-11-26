<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVariantRequest extends FormRequest
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
            "remain_quantity" => "bail|required|integer|min:0|max:4294967295",
            "image" => "bail|mimes:jpg,png,jpeg|max:5048",

        ];
    }

    public function messages(): array
    {
        return [ 
            "remain_quantity.required" => "Số lượng nhập không được để trống !",
            "remain_quantity.integer" => "Dữ liệu phải ở dạng số !",
            "remain_quantity.min" => "Dữ liệu không hợp lệ !",
            "remain_quantity.max" => "Dữ liệu không hợp lệ !",
            'image.mimes' => 'Định dạng file không hợp lệ(jpg, png, jpeg) !',
            'image.max' => 'File nhỏ hơn 5MB !',
        ];
    }
}