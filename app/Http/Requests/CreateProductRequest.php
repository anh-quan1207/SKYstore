<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            "name" => "bail|required|max:255",
            "category_id" => "bail|required|max:255",
            "discount" => "bail|numeric|min:0|max:99.99",
            "images.*" => "bail|mimes:jpg,png,jpeg,webp|max:5048",
            "price" => "bail|required|integer|min:0|max:4294967295",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Tên sản phẩm không được để trống !",
            "name.max" => "Tên sản phẩm không vượt quá 255 ký tự !",
            "category_id.required" => "Danh mục hông được để trống !",
            "category_id.max" => "Danh mục không vượt quá 255 ký tự !",
            "discount.numeric" => "Dữ liệu phải ở dạng số",
            "discount.min" => "Dữ liệu không hợp lệ!",
            "discount.max" => "Dữ liệu không hợp lệ!",
            'images.*.mimes' => 'Định dạng file không hợp lệ(jpg, png, jpeg, webp) !',
            'images.*.max' => 'Mỗi file nhỏ hơn 5MB !',
            "price.required" => "Giá không được để trống !",
            "price.integer" => "Dữ liệu không hợp lệ !",
            "price.max" => "Dữ liệu không hợp lệ !",
            "price.min" => "Dữ liệu không hợp lệ !",
        ];
    }
}