<?php
namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\DonHang;

class HuyDonHangQuaHan
{
    public function handle($request, Closure $next)
    {
        DonHang::where('trang_thai', 'cho_thanh_toan')
            ->where('created_at', '<=', Carbon::now()->subMinutes(3))
            ->update(['trang_thai' => 'da_huy',
        'huy_boi' => 'he_thong',
        ]);
        return $next($request);
    }
}


