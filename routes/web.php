<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BienTheSanPhamController;
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
Route::get('/admin', function () {
    return view('admin.layouts.app');
})->name('admin.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('danhmuc', DanhMucController::class);
    Route::resource('sanpham', SanPhamController::class);
    Route::get('bienthe/{id}/sanpham',[BienTheSanPhamController::class, 'index'])->name('bienthe.index');
    Route::get('bienthe/{id}/create',[BienTheSanPhamController::class, 'create'])->name('bienthe.create');
    Route::post('bienthe',action: [BienTheSanPhamController::class, 'store'])->name('bienthe.store');
    Route::get('bienthe/{id}/edit',[BienTheSanPhamController::class, 'edit'])->name('bienthe.edit');
    Route::put('bienthe/{id}', [BienTheSanPhamController::class, 'update'])->name('bienthe.update');
    Route::delete('bienthe/{id}', [BienTheSanPhamController::class, 'destroy'])->name('bienthe.destroy');

    Route::resource('chip', ChipController::class);
    Route::resource('mainboard', MainboardController::class);
    Route::resource('gpu', GpuController::class);
    Route::resource('ram', RamController::class);
    Route::resource('ocung', OCungController::class);
    Route::resource('thuonghieu', ThuongHieuController::class);
    Route::resource('phuongthucthanhtoan', PhuongThucThanhToanController::class);
    Route::resource('magiamgia', MaGiamGiaController::class);
});

require __DIR__.'/auth.php';
