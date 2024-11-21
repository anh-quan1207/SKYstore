<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductVariantRequest extends FormRequest
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
            "color" => "bail|required|max:255",
            "size" => "bail|required|max:255",
            "remain_quantity" => "bail|required|integer|min:0|max:4294967295",
            "image" => "bail|required|mimes:jpg,png,jpeg,webp|max:5048"
        ];
    }

    public function messages(): array
    {
        return [
            "color.required" => "Màu sắc không được để trống !",
            "color.max" => "Màu sắc không vượt quá 255 ký tự !",
            "size.required" => "Size không được để trống !",
            "size.max" => "Size không vượt quá 255 ký tự !",
            "remain_quantity.required" => "Số lượng nhập không được để trống !",
            "remain_quantity.numeric" => "Dữ liệu phải ở dạng số !",
            "remain_quantity.min" => "Dữ liệu không hợp lệ !",
            "remain_quantity.max" => "Dữ liệu không hợp lệ !",
            "remain_quantity.integer" => "Dữ liệu không hợp lệ !",
            "image.required" => "File không được để trống !",
            'image.mimes' => 'Định dạng file không hợp lệ(jpg, png, jpeg, webp) !',
            'image.max' => 'File nhỏ hơn 5MB !',
        ];
    }
}