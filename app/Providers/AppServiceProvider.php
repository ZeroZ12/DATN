<?php
namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Gửi tên user
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('username', Auth::user()->ten_dang_nhap);
            }
        });

        // Gửi danh mục
        View::composer('*', function ($view) {
            $view->with('danhmucs', DanhMuc::all());
        });

        // Gửi tổng số lượng giỏ hàng
        View::composer('*', function ($view) {
            $tongSoLuongGioHang = 0;

            if (Auth::check()) {
                $gioHang = GioHang::where('id_user', Auth::id())
                    ->where('loai', 'chinh')
                    ->first();

                if ($gioHang) {
                    $tongSoLuongGioHang = ChiTietGioHang::where('id_gio_hang', $gioHang->id)
                        ->sum('so_luong');
                }
            }

            $view->with('tongSoLuongGioHang', $tongSoLuongGioHang);
        });
    }
}

