<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index()
    {
        $customers = $this->customerService->getAll();
        return view('admin.customer.list-customer', ['customers' => $customers,'increment' => 0]);
    }

    public function updateUsername(Request $request)
    {
        $rules = [
            "username" => "bail|required|max:255",

        ];
        $messages = [
            "username.required" => "Tên đăng nhập không được để trống! ",
            "username.max" => "Tên đăng nhập không vượt quá 255 kí tự!",
        ];
        $request->validate($rules, $messages);
        $customer = Auth::user();
        $usernameInput = $request->input('username');
        if($usernameInput == $customer->username) {
            return redirect()->back()->withErrors([
                'username' => 'Tên đăng nhập không thay đổi!',
            ]);
        }

        $usernameExists = $this->customerService->usernameExists($customer->id, $usernameInput);
        if($usernameExists) {
            return redirect()->back()->withErrors([
                'username' => 'Tên đăng nhập đã tồn tại!',
            ]);
        }

        $resultUpdate = $this->customerService->updateUsername($customer, $usernameInput);
        if ($resultUpdate) {
            $result = [
                $message = "Cập nhật tên đăng nhập thành công",
                $status = 'success',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        } else {
            $result = [
                $message = "Cập nhật tên đăng nhập thất bại",
                $status = 'error',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        }
    }

    public function updateEmail(Request $request)
    {
        $rules = [
            "email" => "bail|required|email|max:255",

        ];
        $messages = [
            "email.required" => "Email không được để trống!",
            "email.email" => "Email không đúng định dạng!",
            "email.max" => "Email không vượt quá 255 kí tự!",
        ];
        $request->validate($rules, $messages);
        $customer = Auth::user();
        $emailInput = $request->input('email');
        if ($emailInput == $customer->email) {
            return redirect()->back()->withErrors([
                'email' => 'Email không thay đổi!',
            ]);
        }

        $emailExists = $this->customerService->emailExists($customer->id, $emailInput);
        if ($emailExists) {
            return redirect()->back()->withErrors([
                'email' => 'Email đã tồn tại!',
            ]);
        }

        $resultUpdate = $this->customerService->updateEmail($customer, $emailInput);
        if ($resultUpdate) {
            $result = [
                $message = "Cập nhật email thành công",
                $status = 'success',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        } else {
            $result = [
                $message = "Cập nhật email thất bại",
                $status = 'error',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        }
    }

    public function formChangePassword()
    {
        return view('user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            "current_password" => "bail|required|max:255",
            "password" => "bail|required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/|confirmed",

        ];
        $messages = [
            "current_password.max" => "Mật khẩu không vượt quá 255 ký tự !",
            "current_password.required" => "Mật khẩu không được để trống !",
            "password.required" => "Mật khẩu không được để trống !",
            "password.confirmed" => "Xác nhận mật khẩu không khớp !",
            "password.min" => "Mật khẩu ít nhất 6 ký tự !",
            "password.max" => "Mật khẩu không vượt quá 255 ký tự !",
            "password.regex" => "Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt !",
        ];

        $request->validate($rules, $messages);
        $customer = Auth::user();
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');
        $verifyOldPassword = password_verify($currentPassword, $customer->password);
        if(!$verifyOldPassword) {
            return redirect()->back()->withErrors([
                'current_password' => 'Mật khẩu hiện tại không chính xác!',
            ]);
        }

        $resultUpdate = $this->customerService->updatePassword($customer, $newPassword);
        if ($resultUpdate) {
            $result = [
                $message = "Cập nhật mật khẩu thành công",
                $status = 'success',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        } else {
            $result = [
                $message = "Cập nhật mật khẩu thất bại",
                $status = 'error',
            ];
            return redirect()->route('account-infor')->with('result', $result);
        }


    }
}
