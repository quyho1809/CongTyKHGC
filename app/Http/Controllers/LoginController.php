<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserStatus;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function ShowLogin()
    {
        return view('components.login');
    }
    public function login(Request $CheckUser)
    {
        $credentials = $CheckUser->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $CheckUser->session()->regenerate();
            $user = Auth::user();
    
            if ($user->status == 0) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
            }
    
            if ($user->status == 1) {
                return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
            }
    
            if ($user->status == 2) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị từ chối.');
            }
    
            if ($user->status == 3) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }
        }
    
        return back()->with('error', 'Sai tài khoản hoặc mật khẩu');
    }
    

    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->route('login')->with('success','Dang xuat thanh cong');
    }
    
}

