<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        //kiem tra xem nguoi dung da dang nhap chua
        if ( !in_array(Auth::user()->vai_tro,  $roles) ) {
            return abort(403, 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
