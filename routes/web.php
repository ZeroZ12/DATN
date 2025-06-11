<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BienTheSanPhamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChipController;
use App\Http\Controllers\Admin\MainboardController;
use App\Http\Controllers\Admin\GpuController;
use App\Http\Controllers\Admin\RamController;
use App\Http\Controllers\Admin\OCungController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Admin\PhuongThucThanhToanController;
use App\Http\Controllers\Admin\MaGiamGiaController;
use App\Http\Middleware\CheckUserStatus;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'check.role:quan_tri'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('danhmuc', DanhMucController::class);
    Route::resource('sanpham', SanPhamController::class);
    Route::get('bienthe/{id}/sanpham', [BienTheSanPhamController::class, 'index'])->name('bienthe.index');
    Route::get('bienthe/{id}/create', [BienTheSanPhamController::class, 'create'])->name('bienthe.create');
    Route::post('bienthe', [BienTheSanPhamController::class, 'store'])->name('bienthe.store');
    Route::get('bienthe/{id}/edit', [BienTheSanPhamController::class, 'edit'])->name('bienthe.edit');
    Route::put('bienthe/{id}', [BienTheSanPhamController::class, 'update'])->name('bienthe.update');
    Route::delete('bienthe/{id}', [BienTheSanPhamController::class, 'destroy'])->name('bienthe.destroy');

    Route::prefix('chip')->name('chip.')->group(function () {
    // ✔ CÁC ROUTE CỤ THỂ TRƯỚC
    Route::get('/trash', [ChipController::class, 'trash'])->name('trash');
    Route::patch('/restore/{id}', [ChipController::class, 'restore'])->name('restore');
    Route::delete('/force-delete/{id}', [ChipController::class, 'forceDelete'])->name('forceDelete');

    // ❗ SAU ĐÓ mới đến route động
    Route::get('/', [ChipController::class, 'index'])->name('index');
    Route::get('/create', [ChipController::class, 'create'])->name('create');
    Route::post('/', [ChipController::class, 'store'])->name('store');
    Route::get('/{chip}', [ChipController::class, 'show'])->name('show');
    Route::get('/{chip}/edit', [ChipController::class, 'edit'])->name('edit');
    Route::put('/{chip}', [ChipController::class, 'update'])->name('update');
    Route::delete('/{chip}', [ChipController::class, 'destroy'])->name('destroy');
});



    Route::resource('mainboard', MainboardController::class);
    Route::resource('gpu', GpuController::class);
    Route::resource('ram', RamController::class);
    Route::resource('ocung', OCungController::class);
    Route::resource('thuonghieu', ThuongHieuController::class);
    Route::resource('phuongthucthanhtoan', PhuongThucThanhToanController::class);
    Route::resource('magiamgia', MaGiamGiaController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/hide', [UserController::class, 'hide'])->name('users.hide');



});

Route::middleware(['auth', CheckUserStatus::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'check.role:quan_tri'])->get('/admin', function () {
    return view('admin.layouts.app');
})->name('admin.index');


require __DIR__ . '/auth.php';
