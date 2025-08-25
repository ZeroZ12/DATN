<?php

use App\Http\Controllers\admin\AdminSuKienController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\SearcherController;
use App\Http\Controllers\ThongKeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\Admin\GpuController;
use App\Http\Controllers\Admin\RamController;
use App\Http\Controllers\Admin\OCungController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Admin\PhuongThucThanhToanController;
use App\Http\Controllers\Admin\MaGiamGiaController;
use App\Http\Controllers\Admin\DanhGiaController;
use App\Http\Controllers\Admin\TanNhietController;
use App\Http\Controllers\Admin\CasesController;
use App\Http\Controllers\Admin\NguonController;

// use App\Http\Controllers\Admin\RamController;
use App\Http\Controllers\Admin\ChipController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\CasesController;
// use App\Http\Controllers\Admin\NguonController;
// use App\Http\Controllers\Admin\OCungController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\OrderController;
// use App\Http\Controllers\Admin\DanhGiaController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;

use App\Http\Controllers\Admin\SanPhamController;
// use App\Http\Controllers\Admin\TanNhietController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProfileController;
// use App\Http\Controllers\Admin\MaGiamGiaController;
use App\Http\Controllers\Admin\MainboardController;
// use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Client\UserAddressController;
use App\Http\Controllers\Admin\BienTheSanPhamController;
use App\Http\Controllers\Client\DanhGiaSanPhamController;
// use App\Http\Controllers\Admin\PhuongThucThanhToanController;
use App\Http\Controllers\Client\SanPhamController as ClientSanPhamController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\YeuCauHoanTraController as ClientYCHT;
use App\Http\Controllers\Admin\YeuCauHoanTraController as AdminYCHT;
use App\Http\Controllers\ProductSearchController;



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'check.role:quan_tri'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('danhmuc/trash', [DanhMucController::class, 'trashed'])->name('danhmuc.trashed');
    Route::post('danhmuc/{id}/restore', [DanhMucController::class, 'restore'])->name('danhmuc.restore');
    Route::delete('danhmuc/{id}/force-delete', [DanhMucController::class, 'forceDelete'])->name('danhmuc.forceDelete');
    Route::resource('danhmuc', DanhMucController::class);

    Route::get('sukien/trashed', [AdminSuKienController::class, 'trashed'])->name('sukien.trashed');
    Route::post('sukien/{id}/restore', [AdminSuKienController::class, 'restore'])->name('sukien.restore');
    Route::delete('sukien/{id}/force-delete', [AdminSuKienController::class, 'forceDelete'])->name('sukien.forceDelete');
    Route::patch('sukien/toggle-display/{id}', [AdminSuKienController::class, 'toggleDisplay'])->name('sukien.toggle-display');
    Route::resource('sukien', AdminSuKienController::class);


    Route::prefix('sanpham')->name('sanpham.')->group(function () {
        Route::get('/thungrac', [SanPhamController::class, 'trash'])->name('trash');
        Route::post('/{id}/restore', [SanPhamController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [SanPhamController::class, 'forceDelete'])->name('forceDelete');
        // Resource route

        Route::resource('/', SanPhamController::class)->parameters(['' => 'sanpham']);

        Route::resource('{sanpham}/bienthe', BienTheSanPhamController::class)->except(['show']);

        Route::get('bienthe/trashed', [BienTheSanPhamController::class, 'trashed'])->name('bienthe.trashed');
        Route::post('bienthe/{bienthe}/restore', [BienTheSanPhamController::class, 'restore'])
            ->name('bienthe.restore')
            ->withTrashed(); // <-- Sửa {id} thành {bienthe} và THÊM DÒNG NÀY
        Route::delete('bienthe/{bienthe}/force-delete', [BienTheSanPhamController::class, 'forceDelete'])
            ->name('bienthe.forceDelete')
            ->withTrashed(); // <-- Sửa {id} thành {bienthe} và THÊM DÒNG NÀY
    });

    // Route banner
    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/', [BannerController::class, 'store'])->name('store');
        Route::get('/show/{id}', [BannerController::class, 'show'])->name('show');

        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BannerController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [BannerController::class, 'destroy'])->name('destroy');
        Route::get('trashed/', [BannerController::class, 'trashed'])->name('trashed');
        Route::post('restore/{id}', [BannerController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [BannerController::class, 'forceDelete'])->name('forceDelete');
        Route::get('showall', [BannerController::class, 'showall'])->name('showall');
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

    Route::prefix('case')->name('case.')->group(function () {
        // ✔ CÁC ROUTE CỤ THỂ TRƯỚC
        Route::get('/trash', [CasesController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [CasesController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [CasesController::class, 'forceDelete'])->name('forceDelete');

        // ❗ SAU ĐÓ mới đến route động
        Route::get('/', [CasesController::class, 'index'])->name('index');
        Route::get('/create', [CasesController::class, 'create'])->name('create');
        Route::post('/', [CasesController::class, 'store'])->name('store');
        Route::get('/{cases}', [CasesController::class, 'show'])->name('show');
        Route::get('/{cases}/edit', [CasesController::class, 'edit'])->name('edit');
        Route::put('/{cases}', [CasesController::class, 'update'])->name('update');
        Route::delete('/{cases}', [CasesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('nguon')->name('nguon.')->group(function () {
        // ✔ CÁC ROUTE CỤ THỂ TRƯỚC
        Route::get('/trash', [NguonController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [NguonController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [NguonController::class, 'forceDelete'])->name('forceDelete');

        // ❗ SAU ĐÓ mới đến route động
        Route::get('/', [NguonController::class, 'index'])->name('index');
        Route::get('/create', [NguonController::class, 'create'])->name('create');
        Route::post('/', [NguonController::class, 'store'])->name('store');
        Route::get('/{nguon}', [NguonController::class, 'show'])->name('show');
        Route::get('/{nguon}/edit', [NguonController::class, 'edit'])->name('edit');
        Route::put('/{nguon}', [NguonController::class, 'update'])->name('update');
        Route::delete('/{nguon}', [NguonController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tannhiet')->name('tannhiet.')->group(function () {
        // ✔ CÁC ROUTE CỤ THỂ TRƯỚC
        Route::get('/trash', [TanNhietController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [TanNhietController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [TanNhietController::class, 'forceDelete'])->name('forceDelete');

        // ❗ SAU ĐÓ mới đến route động
        Route::get('/', [TanNhietController::class, 'index'])->name('index');
        Route::get('/create', [TanNhietController::class, 'create'])->name('create');
        Route::post('/', [TanNhietController::class, 'store'])->name('store');
        Route::get('/{tannhiet}', [TanNhietController::class, 'show'])->name('show');
        Route::get('/{tannhiet}/edit', [TanNhietController::class, 'edit'])->name('edit');
        Route::put('/{tannhiet}', [TanNhietController::class, 'update'])->name('update');
        Route::delete('/{tannhiet}', [TanNhietController::class, 'destroy'])->name('destroy');
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

    Route::get('danhgias', [DanhGiaController::class, 'index'])->name('danhgias.index');
    Route::get('danhgias/{danhGia}', [DanhGiaController::class, 'show'])->name('danhgias.show');
    Route::get('danhgias/{danhGia}/edit', [DanhGiaController::class, 'edit'])->name('danhgias.edit');
    Route::put('danhgias/{danhGia}', [DanhGiaController::class, 'update'])->name('danhgias.update');
    // Hoặc nếu bạn chỉ muốn dùng PATCH cho update: Route::patch('danhgias/{danhGia}', [DanhGiaController::class, 'update'])->name('danhgias.update');

    // Xóa đánh giá (DELETE /admin/danhgias/{danhgia})
    Route::delete('danhgias/{danhGia}', [DanhGiaController::class, 'destroy'])->name('danhgias.destroy');
    Route::patch('danhgias/{danhGia}/approve', [DanhGiaController::class, 'approve'])->name('danhgias.approve');
    Route::patch('danhgias/{danhGia}/reject', [DanhGiaController::class, 'reject'])->name('danhgias.reject');

    //Đơn hàng
    Route::get('don-hang', [DonHangController::class, 'index'])->name('don-hang.index');
    Route::get('don-hang/{id}', action: [DonHangController::class, 'show'])->name('don-hang.show');
    Route::post('don-hang/{id}/cap-nhat-trang-thai', [DonHangController::class, 'capNhatTrangThai'])->name('don-hang.cap-nhat-trang-thai');
    Route::get('admin/don-hang/revenue-list', [\App\Http\Controllers\Admin\DonHangController::class, 'revenueList'])->name('don-hang.revenue-list');

    Route::get('/hoan-tra', [AdminYCHT::class, 'index'])->name('hoan-tra.index');
    Route::get('/hoan-tra/{id}', [AdminYCHT::class, 'show'])->name('hoan-tra.show');
    Route::post('/hoan-tra/{id}/cap-nhat-trang-thai', [AdminYCHT::class, 'capNhatTrangThai'])
        ->name('hoan-tra.cap-nhat-trang-thai');

    Route::get('/admin/thong-ke', [ThongKeController::class, 'index'])->name('thongke');
Route::post('/admin/thong-ke/filter', [ThongKeController::class, 'filter'])->name('thongke.filter');


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

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/success/{id}', [OrderController::class, 'success'])->name('orders.success');
    Route::post('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/don-hang/{id}/da-nhan', [OrderController::class, 'daNhanHang'])->name('orders.daNhanHang');

    //hoàn trả
    Route::get('/don-hang/{id}/hoan-tra', [ClientYCHT::class, 'create'])->name('hoan-tra.create');
    Route::post('/don-hang/{id}/hoan-tra', [ClientYCHT::class, 'store'])->name('hoan-tra.store');
    Route::post('/don-hang/{id}/tra-hang', [ClientYCHT::class, 'traHang'])
        ->name('hoan-tra.trahang');


    // Route để cập nhật đánh giá (sử dụng PATCH/PUT)
    Route::post('/reviews', [DanhGiaSanPhamController::class, 'store'])->name('reviews.store');
    Route::patch('/reviews/{danhGiaSanPham}', [DanhGiaSanPhamController::class, 'update'])->name('reviews.update');
    // Route để xóa đánh giá (sử dụng DELETE)
    Route::delete('/reviews/{danhGiaSanPham}', [DanhGiaSanPhamController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware(['auth', 'check.role:quan_tri'])->get('/admin', [DashBoardController::class, 'index'])->name('admin.index');

//Route client
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/chinhsach', [HomeController::class, 'policy'])->name('client.policy');
Route::get('/danhmuc/{id}', [ClientSanPhamController::class, 'danhmuc'])->name('danhmuc.index');
Route::get('/danhmuc/{id}/show', [ClientSanPhamController::class, 'danhmuc'])->name('danhmuc.show');
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
        Route::post('/buy-now', [App\Http\Controllers\Client\CartController::class, 'buyNow'])->name('buy-now');
        Route::put('/update/{id}', [App\Http\Controllers\Client\CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [App\Http\Controllers\Client\CartController::class, 'remove'])->name('remove');
        Route::get('/count', [App\Http\Controllers\Client\CartController::class, 'count'])->name('count');
        Route::get('/checkout', [App\Http\Controllers\Client\CartController::class, 'checkout'])->name('checkout');
        Route::post('/place-order', [App\Http\Controllers\Client\CartController::class, 'placeOrder'])->name('place-order');
    });

    // Payment routes
    Route::get('/payment/{id}', [App\Http\Controllers\Client\PaymentController::class, 'index'])->name('client.payment');
    Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('client.vnpay.return');

    Route::get('/payment-fail/{id}', [PaymentController::class, 'paymentFail'])->name('client.payment.fail');
    Route::get('/order/success/{id}', [App\Http\Controllers\Client\OrderController::class, 'success'])->name('client.order.success');
});
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->middleware('auth');
Route::delete('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->middleware('auth');
Route::get('/search', [SearcherController::class, 'search'])->name('searcher.search'); // Thêm route tìm kiếm

use App\Http\Controllers\ChatController;

Route::post('/chat/search', [ChatController::class, 'search'])->name('chat.search');
