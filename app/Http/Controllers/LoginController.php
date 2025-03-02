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
        $checkLogin = Auth::guard('user')->attempt([
            'email' => $CheckUser->email,
            'password' => $CheckUser->password
        ]);

        if($checkLogin)
        {
            $user = Auth::guard('user')->user();

            if ($user->status == 0)
            {
                Auth::guard('user')->logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
            }
            
            if ($user->status == 1)
            {
                return view('components.dashboard')->with('success','Dang nhap thanh cong');
            }
            if ($user->status == 2) 
            {
                Auth::guard('user')->logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị tu choi.');
            }

            if ($user->status == 3) 
            {
                Auth::guard('user')->logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }

        }
        
        return redirect()->route('login')->with('error','Sai tai khoan hoac mat khau');


        
    }


    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->route('login')->with('success','Dang xuat thanh cong');
    }
    
}

