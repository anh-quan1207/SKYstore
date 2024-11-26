<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            "parent_category" => "bail|required|between:1,3",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Tên danh mục không được để trống !",
            "name.max" => "Tên danh mục không vượt quá 255 ký tự !",
            "parent_category.parent_category" => "Loại danh mục không được để trống !",
            "parent_category.between" => "Dữ liệu không hợp lệ !",
        ];
    }
}
