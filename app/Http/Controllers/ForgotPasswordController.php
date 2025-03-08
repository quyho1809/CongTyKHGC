<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Jobs\SendResetPasswordEmailJob;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    // Kiểm tra user có tồn tại hay không
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại.']);
    }
    
    // Tạo token reset password (có thể sử dụng Password Broker của Laravel hoặc tự sinh token)
    $token = str_random(60);
    
    // Lưu token vào bảng password_resets hoặc cơ chế lưu trữ tương ứng
    
    // Dispatch job gửi mail
    dispatch(new SendResetPasswordEmailJob($user->email, $token));
    
    return back()->with('success', 'Đã gửi liên kết đặt lại mật khẩu. Vui lòng kiểm tra email của bạn.');
}

}
