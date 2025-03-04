<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendResetPasswordEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ResetPasswordRequest;
use App\Notifications\PasswordResetSuccess;



class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('components.forgot-password');
    }

    public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    if ($status === Password::RESET_LINK_SENT) {
        $token = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->value('token');
    
        dispatch(new SendResetPasswordEmail($request->email, $token));
    
        return back()->with(['status' => __($status)]);
    }

    return back()->withErrors(['email' => __($status)]);
}

public function showResetForm($token)
{
    return view('components.reset-password', compact('token'));
}


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

