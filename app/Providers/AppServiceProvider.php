<?php

namespace App\Providers;

use App\Models\DanhMuc;
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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('username', Auth::user()->ten_dang_nhap); // hoặc 'username' tùy cột DB
            }
        });
         View::composer('*', function ($view) {
        $view->with('danhmucs', DanhMuc::all());
    });
    }
}
