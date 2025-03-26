<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function ShowLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            if ($user->status == 0) { 
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
            }
        
            if ($user->status == 2) { 
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị từ chối.');
            }
        
            if ($user->status == 3) { 
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }
        
            if ($user->status === 1) { 
                return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
            }
        }

        return back()->with('error', 'Sai tài khoản hoặc mật khẩu.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Đăng xuất thành công!');
    }
}
