<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserStatus;

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BienTheSanPhamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChipController;
use App\Http\Controllers\Admin\MainboardController;
use App\Http\Controllers\Admin\GpuController;
use App\Http\Controllers\Admin\RamController;
use App\Http\Controllers\Admin\OCungController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Admin\PhuongThucThanhToanController;
use App\Http\Controllers\Admin\MaGiamGiaController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\UserAddressController;
use App\Http\Controllers\Client\SanPhamController as ClientSanPhamController;


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'check.role:quan_tri'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('danhmuc/trashed', [DanhMucController::class, 'trashed'])->name('danhmuc.trashed');
    Route::post('danhmuc/{id}/restore', [DanhMucController::class, 'restore'])->name('danhmuc.restore');
    Route::delete('danhmuc/{id}/force-delete', [DanhMucController::class, 'forceDelete'])->name('danhmuc.forceDelete');
    Route::resource('danhmuc', DanhMucController::class);



    Route::prefix('sanpham')->name('sanpham.')->group(function () {
        Route::get('/thungrac', [SanPhamController::class, 'trash'])->name('trash');
        Route::post('/{id}/restore', [SanPhamController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [SanPhamController::class, 'forceDelete'])->name('forceDelete');
        // Resource route

        Route::resource('', SanPhamController::class)->parameters(['' => 'sanpham']);

        Route::resource('{sanpham}/bienthe', BienTheSanPhamController::class)->except(['show']);

        Route::get('bienthe/trashed', [BienTheSanPhamController::class, 'trashed'])->name('bienthe.trashed');
        Route::post('bienthe/{bienthe}/restore', [BienTheSanPhamController::class, 'restore'])
            ->name('bienthe.restore')
            ->withTrashed(); // <-- Sửa {id} thành {bienthe} và THÊM DÒNG NÀY
        Route::delete('bienthe/{bienthe}/force-delete', [BienTheSanPhamController::class, 'forceDelete'])
            ->name('bienthe.forceDelete')
            ->withTrashed(); // <-- Sửa {id} thành {bienthe} và THÊM DÒNG NÀY
    });




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
    Route::post('thuonghieu/{id}/restore', [ThuongHieuController::class, 'restore'])->name('thuonghieu.restore');
    Route::delete('thuonghieu/{id}/forceDelete', [ThuongHieuController::class, 'forceDelete'])->name('thuonghieu.forceDelete');
    Route::resource('thuonghieu', ThuongHieuController::class);


    Route::post('phuongthucthanhtoan/{id}/restore', [PhuongThucThanhToanController::class, 'restore'])->name('phuongthucthanhtoan.restore');
    Route::delete('phuongthucthanhtoan/{id}/forceDelete', [PhuongThucThanhToanController::class, 'forceDelete'])->name('phuongthucthanhtoan.forceDelete');
    Route::resource('phuongthucthanhtoan', PhuongThucThanhToanController::class);

    Route::post('magiamgia/{id}/restore', [MaGiamGiaController::class, 'restore'])->name('magiamgia.restore');
    Route::delete('magiamgia/{id}/forceDelete', [MaGiamGiaController::class, 'forceDelete'])->name('magiamgia.forceDelete');
    Route::resource('magiamgia', MaGiamGiaController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/hide', [UserController::class, 'hide'])->name('users.hide');
});

Route::middleware(['auth', CheckUserStatus::class])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.tk.access');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('addresses', UserAddressController::class)->except(['show']); // Không cần show riêng lẻ, index sẽ list
    Route::post('addresses/{address}/set-default', [UserAddressController::class, 'setDefault'])->name('addresses.setDefault');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update'); // <<< Route mới cho cập nhật mật khẩu

});

Route::middleware(['auth', 'check.role:quan_tri'])->get('/admin', function () {
    return view('admin.layouts.app');
})->name('admin.index');

//Route client
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/danhmuc/{id}', [ClientSanPhamController::class, 'danhmuc'])->name('danhmuc.index');
Route::get('/sanpham/{id}', [ClientSanPhamController::class, 'show'])->name('sanpham.show');
// Route tìm kiếm sản phẩm
Route::get('/search', [ClientSanPhamController::class, 'search'])->name('search');

Route::get('/form', [AuthController::class, 'showForm'])->name('form');
Route::get('/login', function () {
    return redirect()->route('form', ['type' => 'login']);
});
Route::get('/register', function () {
    return redirect()->route('form', ['type' => 'register']);
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Cart routes
Route::middleware(['auth'])->group(function () {
    // Cart routes
    Route::prefix('cart')->name('client.cart.')->group(function () {
        Route::get('/', [App\Http\Controllers\Client\CartController::class, 'index'])->name('index');
        Route::post('/add', [App\Http\Controllers\Client\CartController::class, 'add'])->name('add');
        Route::put('/update/{id}', [App\Http\Controllers\Client\CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [App\Http\Controllers\Client\CartController::class, 'remove'])->name('remove');
        Route::get('/count', [App\Http\Controllers\Client\CartController::class, 'count'])->name('count');
        Route::get('/checkout', [App\Http\Controllers\Client\CartController::class, 'checkout'])->name('checkout');
        Route::post('/place-order', [App\Http\Controllers\Client\CartController::class, 'placeOrder'])->name('place-order');

    });

    // Payment routes
    Route::get('/payment/{id}', [App\Http\Controllers\Client\PaymentController::class, 'index'])->name('client.payment');
    Route::get('/order/success/{id}', [App\Http\Controllers\Client\OrderController::class, 'success'])->name('client.order.success');
});
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->middleware('auth');