<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{   
    $user = Auth::user();

    if (!$user || $user->role !== 'admin') {
        return abort(403, 'Bạn không có quyền truy cập.');
    }

    return $next($request);
}
}
