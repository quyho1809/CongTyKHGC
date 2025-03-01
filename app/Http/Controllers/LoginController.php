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
        $user = User::where('email',$CheckUser->email)->first();

        if ($user->status == 0)
        {
            return redirect()->route('login')->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
        }
        if ($user->status == 1)
        {
            return view('components.bloglist');
        }
        if ($user->status == 3) 
        {
            return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        return view('components.dashboard');

        
    }

    
}

