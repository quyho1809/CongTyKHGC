<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    
    public function handle(Request $request, Closure $next)
    {
        //.
        if (Auth::guard('users')->check())
        {
            $user = Auth::guard('users')->user();
            if ($user->status == 0)
            {
                return back()->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
            }
            if ($user->status == 1)
            {
                           
                return $next($request);
            }
            if ($user->status == 3) 
            {
                return back()->with('error', 'Tài khoản của bạn đã bị khóa.');
            }
    
            if ($user->status == 2) 
            {
                return back()->with('error', 'Tài khoản của bạn đã bị từ chối.');
            }

        }
        else 
             return redirect()->route('login')->with('error', 'Ban Can Phai Dang Nhap');


     
        

        
    }
}
