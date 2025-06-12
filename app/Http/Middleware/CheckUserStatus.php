<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(Auth::user()->trang_thai, ['an', 'vo_hieu'])) {
            Auth::logout(); // Đăng xuất user bị ẩn hoặc vô hiệu hóa
            return redirect('/login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa hoặc ẩn.');
        }

        return $next($request);
    }
}
