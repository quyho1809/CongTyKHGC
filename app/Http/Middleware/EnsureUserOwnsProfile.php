<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\EnsureUserOwnsProfile;

class EnsureUserOwnsProfile
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->id !== $request->route('user')->id) {
            abort(403, 'Bạn không có quyền chỉnh sửa hồ sơ này.');
        }
        return $next($request);
    }
}

