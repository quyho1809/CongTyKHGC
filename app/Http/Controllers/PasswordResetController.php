<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendResetPasswordEmail;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;


class PasswordResetController extends Controller
{
    // Hiển thị form nhập email để nhận link reset password
    public function showLinkRequestForm()
    {
        return view('components.forgot-password');
    }

    // Gửi email chứa link reset password
    public function sendResetLink(Request $request)
    {
        
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            // Lấy token từ bảng password_reset_tokens
            $token = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->value('token');

            // Đẩy job vào hàng đợi
            dispatch(new SendResetPasswordEmailJob($request->email, $token));

            return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // Hiển thị form nhập mật khẩu mới
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email'); // Lấy email từ URL
        return view('components.reset-password', compact('email', 'token'));
    }
    

    // Xử lý đặt lại mật khẩu
    public function reset(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công. Hãy đăng nhập!');
        }

        return back()->withInput()->withErrors(['email' => __($status)]);
    }
}

