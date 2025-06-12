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
use App\Http\Controllers\SanPhamController as ControllersSanPhamController;
use App\Http\Middleware\CheckUserStatus;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', function () {
//     return view('admin.layouts.app');
// })->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'check.role:quan_tri'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('danhmuc', DanhMucController::class);

    Route::resource('sanpham', SanPhamController::class);
    Route::post('sanpham/{id}/restore', [SanPhamController::class, 'restore'])->name('sanpham.restore');
    Route::delete('sanpham/{id}/force-delete', [SanPhamController::class, 'forceDelete'])->name('sanpham.forceDelete');

    Route::get('bienthe/{id}/sanpham', [BienTheSanPhamController::class, 'index'])->name('bienthe.index');
    Route::get('bienthe/{id_product}/create', [BienTheSanPhamController::class, 'create'])->name('bienthe.create');
    Route::post('bienthe', [BienTheSanPhamController::class, 'store'])->name('bienthe.store');
    Route::get('bienthe/{id}/edit', [BienTheSanPhamController::class, 'edit'])->name('bienthe.edit');
    Route::put('bienthe/{id}', [BienTheSanPhamController::class, 'update'])->name('bienthe.update');
    Route::delete('bienthe/{id}', [BienTheSanPhamController::class, 'destroy'])->name('bienthe.destroy');


    Route::post('bienthe/{id}/restore', [BienTheSanPhamController::class, 'restore'])->name('bienthe.restore');
    Route::delete('bienthe/{id}/force-delete', [BienTheSanPhamController::class, 'forceDelete'])->name('bienthe.forceDelete');

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



    Route::prefix('mainboard')->name('mainboard.')->group(function () {
        // Các route liên quan đến xóa mềm - đặt TRƯỚC
        Route::get('/trash', [MainboardController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [MainboardController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [MainboardController::class, 'forceDelete'])->name('forceDelete');

        // Các route resource chuẩn
        Route::get('/', [MainboardController::class, 'index'])->name('index');
        Route::get('/create', [MainboardController::class, 'create'])->name('create');
        Route::post('/', [MainboardController::class, 'store'])->name('store');
        Route::get('/{mainboard}', [MainboardController::class, 'show'])->name('show');
        Route::get('/{mainboard}/edit', [MainboardController::class, 'edit'])->name('edit');
        Route::put('/{mainboard}', [MainboardController::class, 'update'])->name('update');
        Route::delete('/{mainboard}', [MainboardController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('gpu')->name('gpu.')->group(function () {
        Route::get('/trash', [GpuController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [GpuController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [GpuController::class, 'forceDelete'])->name('forceDelete');

        Route::get('/', [GpuController::class, 'index'])->name('index');
        Route::get('/create', [GpuController::class, 'create'])->name('create');
        Route::post('/', [GpuController::class, 'store'])->name('store');
        Route::get('/{gpu}', [GpuController::class, 'show'])->name('show');
        Route::get('/{gpu}/edit', [GpuController::class, 'edit'])->name('edit');
        Route::put('/{gpu}', [GpuController::class, 'update'])->name('update');
        Route::delete('/{gpu}', [GpuController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ram')->name('ram.')->group(function () {
        // Route thùng rác trước
        Route::get('/trash', [RamController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [RamController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [RamController::class, 'forceDelete'])->name('forceDelete');

        // Route resource chính
        Route::get('/', [RamController::class, 'index'])->name('index');
        Route::get('/create', [RamController::class, 'create'])->name('create');
        Route::post('/', [RamController::class, 'store'])->name('store');
        Route::get('/{ram}', [RamController::class, 'show'])->name('show');
        Route::get('/{ram}/edit', [RamController::class, 'edit'])->name('edit');
        Route::put('/{ram}', [RamController::class, 'update'])->name('update');
        Route::delete('/{ram}', [RamController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ocung')->name('ocung.')->group(function () {
        // Soft delete
        Route::get('/trash', [OCungController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [OCungController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [OCungController::class, 'forceDelete'])->name('forceDelete');

        // Resource routes
        Route::get('/', [OCungController::class, 'index'])->name('index');
        Route::get('/create', [OCungController::class, 'create'])->name('create');
        Route::post('/', [OCungController::class, 'store'])->name('store');
        Route::get('/{ocung}', [OCungController::class, 'show'])->name('show');
        Route::get('/{ocung}/edit', [OCungController::class, 'edit'])->name('edit');
        Route::put('/{ocung}', [OCungController::class, 'update'])->name('update');
        Route::delete('/{ocung}', [OCungController::class, 'destroy'])->name('destroy');
    });

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

//Route client
Route::get('/', [ControllersSanPhamController::class, 'index'])->name('client.home');
Route::get('/danh-muc/{id}', [DanhMucController::class, 'show'])->name('danhmuc.show');


require __DIR__ . '/auth.php';
