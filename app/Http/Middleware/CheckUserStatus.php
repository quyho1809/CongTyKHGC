<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->refresh(); 
    
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
        }
    
        return $next($request);
    }
    
}
