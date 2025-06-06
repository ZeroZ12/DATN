<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //kiem tra xem nguoi dung da dang nhap chua
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }
        //kiem tra vai tro cua nguoi dung
        if ($request->user()->vai_tro !== 'quan_tri') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }
        return $next($request);
    }
}
