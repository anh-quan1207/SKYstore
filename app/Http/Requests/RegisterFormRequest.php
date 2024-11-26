<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            "email" => "bail|required|email|max:255",
            "password" => "bail|required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/|confirmed",
            "birthday" => "bail|required|date|before:today|after:1900-01-01",
        ];
    }

    public function messages(): array
    {
        return [
            "username.required" => "Tên đăng nhập không được để trống !",
            "username.max" => "Tên đăng nhập không vượt quá 255 ký tự !",
            "email.required" => "Email không được để trống !",
            "email.max" => "Email không vượt quá 255 ký tự !",
            "email.email" => "Email không đúng định dạng !",
            "password.required" => "Mật khẩu không được để trống !",
            "password.confirmed" => "Xác nhận mật khẩu không khớp !",
            "password.min" => "Mật khẩu ít nhất 6 ký tự !",
            "password.max" => "Mật khẩu không vượt quá 255 ký tự !",
            "password.regex" => "Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt !",
            "birthday.required" => "Ngày sinh không được để trống !",
            "birthday.date" => "Ngày sinh không hợp lệ !",
            "birthday.before" => "Ngày sinh không hợp lệ !",
            "birthday.after" => "Ngày sinh không hợp lệ !",
            
        ];
    }
}