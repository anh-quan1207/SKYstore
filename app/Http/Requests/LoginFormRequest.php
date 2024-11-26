<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            "username" => "bail|required|max:255",
            "password" => "bail|required|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            "username.required" => "Tên đăng nhập không được để trống.",
            "username.max" => "Tên đăng nhập không vượt quá 255 ký tự.",
            "password.required" => "Mật khẩu không được để trống.",
            "password.max" => "Mật khẩu không vượt quá 255 ký tự.",
        ];
    }
}