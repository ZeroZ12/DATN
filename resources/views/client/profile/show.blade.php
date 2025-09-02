@extends('client.layouts.app')
@section('content')
    <div class=" py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Thông báo -->
                <div class="toast-container">
                    @if (session('success'))
                        <div class="toast success show">
                            <div class="toast-content">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                                <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="toast error show">
                            <div class="toast-content">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ session('error') }}</span>
                                <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Các tab điều hướng --PC -->
                <ul class="nav nav-tabs mb-4 border-0 d-none d-md-flex" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link {{ session('activeTab', $activeTab ?? 'personal-info') == 'personal-info' ? 'active' : '' }}"
                            id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button"
                            role="tab" aria-controls="personal-info" aria-selected="true">Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link {{ session('activeTab', $activeTab ?? '') == 'password-update' ? 'active' : '' }}"
                            id="password-tab" data-bs-toggle="tab" data-bs-target="#password-update" type="button"
                            role="tab" aria-controls="password-update" aria-selected="false">Cập nhật mật khẩu</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link {{ session('activeTab', $activeTab ?? '') == 'addresses' ? 'active' : '' }}"
                            id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses" type="button"
                            role="tab" aria-controls="addresses" aria-selected="false">Địa chỉ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ session('activeTab', $activeTab ?? '') == 'orders' ? 'active' : '' }}"
                            id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab"
                            aria-controls="orders" aria-selected="false">Đơn hàng</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link">
                                Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>   
                <!-- Tab điều hướng MOBILE -->
                <ul class="nav nav-tabs mb-4 border-0 d-flex d-md-none w-100" id="profileTabsMobile" role="tablist"
                    style="position:relative;">
                    <li class="nav-item w-100" style="position:relative;">
                        <button class="nav-link w-100 text-start" id="mobileTabDropdownBtn" type="button"
                            onclick="toggleMobileTabDropdown()">
                            <i class="fas fa-bars me-2"></i> Menu tài khoản
                        </button>
                        <ul id="mobileTabDropdownMenu" class="list-group position-absolute w-100"
                            style="top:100%;left:0;z-index:1000;display:none;">
                            <li>
                                <button class="list-group-item list-group-item-action {{ session('activeTab', $activeTab ?? 'personal-info') == 'personal-info' ? 'active' : '' }}"
                                    onclick="showProfileTab('personal-info');toggleMobileTabDropdown(true)">Thông tin cá nhân
                                </button>
                            </li>
                            <li>
                                <button class="list-group-item list-group-item-action {{ session('activeTab', $activeTab ?? '') == 'password-update' ? 'active' : '' }}"
                                    onclick="showProfileTab('password-update');toggleMobileTabDropdown(true)">Cập nhật mật khẩu
                                </button>
                            </li>
                            <li>
                                <button class="list-group-item list-group-item-action {{ session('activeTab', $activeTab ?? '') == 'addresses' ? 'active' : '' }}"
                                    onclick="showProfileTab('addresses');toggleMobileTabDropdown(true)">Địa chỉ
                                </button>
                            </li>
                            <li>
                                <button class="list-group-item list-group-item-action {{ session('activeTab', $activeTab ?? '') == 'orders' ? 'active' : '' }}"
                                    onclick="showProfileTab('orders');toggleMobileTabDropdown(true)">Đơn hàng
                                </button>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="list-group-item list-group-item-action text-danger">Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabsContent">
                    <!-- Tab Thông tin cá nhân -->
                    <div class="tab-pane fade {{ session('activeTab', $activeTab ?? 'personal-info') == 'personal-info' ? 'show active' : '' }}"
                        id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                        <div class="card shadow-sm border-0">

                            <div class="card-body p-4">
                                @include('client.profile.partials.update-personal-info-form')
                            </div>
                        </div>
                    </div>

                    <!-- Tab Cập nhật mật khẩu -->
                    <div class="tab-pane fade {{ session('activeTab', $activeTab ?? '') == 'password-update' ? 'show active' : '' }}"
                        id="password-update" role="tabpanel" aria-labelledby="password-tab">
                        <div class="card shadow-sm border-0">

                            <div class="card-body p-4">
                                @include('client.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <!-- Tab Địa chỉ -->
                    <div class="tab-pane fade {{ session('activeTab', $activeTab ?? '') == 'addresses' ? 'show active' : '' }}"
                        id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <div class="card shadow-sm border-0">
                            <div
                                class="card-header card-address text-white rounded-top d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 ms-4">Danh Sách Địa Chỉ</h4>
                                <a href="{{ route('client.addresses.create') }}" class="btn btn-sm btn-light">Thêm địa
                                    chỉ</a>
                            </div>
                            <div class="card-body p-4">
                                @if ($user->diaChiNguoiDungs->isEmpty())
                                    <p class="text-muted">Bạn chưa có địa chỉ nào. Hãy thêm một địa chỉ mới!</p>
                                @else
                                    <div class="row row-cols-1 row-cols-md-2 g-3">
                                        @foreach ($user->diaChiNguoiDungs as $address)
                                            <div class="col">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <h6 class="card-text mb-1"><strong>Người Nhận:
                                                            </strong>{{ $address->ten_nguoi_nhan }}</h6>
                                                        <p class="card-text mb-1"><strong>Số điện thoại:</strong>
                                                            {{ $address->so_dien_thoai_nguoi_nhan }}</p>
                                                        <p class="card-text mb-1"><strong>Địa chỉ:</strong>
                                                            {{ $address->dia_chi_day_du }},
                                                            {{ $address->phuong_xa_name }},
                                                            {{ $address->tinh_thanh_pho_name }}</p>
                                                        @if ($address->mac_dinh)
                                                            <span class="badge bg-success mt-2">Mặc định</span>
                                                        @endif
                                                        <div class="mt-3 d-flex gap-2">
                                                            <a href="{{ route('client.addresses.edit', $address) }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i> Sửa
                                                            </a>
                                                            @if (!$address->mac_dinh)
                                                                <form
                                                                    action="{{ route('client.addresses.setDefault', $address) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-success">
                                                                        <i class="fas fa-star"></i> Đặt mặc định
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('client.addresses.destroy', $address) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">
                                                                        <i class="fas fa-trash"></i> Xóa
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tab Đơn hàng -->
                    <div class="tab-pane fade {{ session('activeTab', $activeTab ?? '') == 'orders' ? 'show active' : '' }}"
                        id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="card shadow-sm border-0">

                            <div class="card-body p-4">
                                @if (isset($selectedDonHang))
                                    <!-- Chi tiết đơn hàng -->
                                    <div class="mb-4">
                                        <h5 class="mb-3">Chi tiết đơn hàng #{{ $selectedDonHang->ma_don }}</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Ngày đặt:</strong>
                                                    {{ $selectedDonHang->created_at->format('d/m/Y H:i') }}</p>
                                                <p><strong>Tổng tiền:</strong>
                                                    {{ number_format($selectedDonHang->tong_tien, 0, ',', '.') }} VNĐ</p>
                                                <p><strong>Phương thức thanh toán:</strong>
                                                    @if ($selectedDonHang->phuongThucThanhToan)
                                                        {{ $selectedDonHang->phuongThucThanhToan->ten }}
                                                    @else
                                                        <span class="text-muted">Không xác định</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Trạng thái:</strong>
                                                    @switch($selectedDonHang->trang_thai)
                                                        @case('cho_xac_nhan')
                                                            <span class="badge bg-secondary">Chờ xác nhận</span>
                                                        @break

                                                        @case('cho_thanh_toan')
                                                            <span class="badge bg-info">Chờ thanh toán</span>
                                                        @break

                                                        @case('da_xac_nhan')
                                                            <span class="badge bg-success">Đã xác nhận</span>
                                                        @break

                                                        @case('chuan_bi_hang')
                                                            <span class="badge bg-warning">Chuẩn bị hàng</span>
                                                        @break

                                                        @case('dang_giao_hang')
                                                            <span class="badge bg-primary">Đang giao hàng</span>
                                                        @break

                                                        @case('giao_thanh_cong')
                                                            <span class="badge bg-success">Giao thành công</span>
                                                        @break

                                                        @case('giao_that_bai')
                                                            <span class="badge bg-danger">Giao thất bại</span>
                                                        @break

                                                        @case('hoan_thanh')
                                                            <span class="badge bg-success">Hoàn thành</span>
                                                        @break

                                                        @case('da_hoan_tien')
                                                            <span class="badge bg-info">Đã hoàn tiền</span>
                                                        @break

                                                        @case('da_huy')
                                                            <span class="badge bg-danger">Đã hủy</span>
                                                        @break

                                                        @case('yeu_cau_hoan_tra')
                                                            <span class="badge bg-dark">Yêu cầu hoàn trả</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">Không xác định</span>
                                                    @endswitch
                                                </p>
                                                <p><strong>Thao tác:</strong>
                                                    @if (in_array($selectedDonHang->trang_thai, ['cho_xac_nhan', 'cho_thanh_toan']))
                                                        <form
                                                            action="{{ route('client.orders.cancel', $selectedDonHang->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="trang_thai_hien_tai"
                                                                value="{{ $selectedDonHang->trang_thai }}">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                                                                <i class="fas fa-times"></i> Hủy đơn hàng
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($selectedDonHang->trang_thai == 'giao_thanh_cong' && !$selectedDonHang->yeuCauHoanTra)
                                                        <a href="{{ route('client.hoan-tra.create', $selectedDonHang->id) }}"
                                                            class="btn btn-sm btn-outline-warning"
                                                            onclick="return confirm('Bạn muốn tạo yêu cầu hoàn trả đơn hàng này?')">
                                                            <i class="fas fa-undo"></i> Hoàn trả
                                                        </a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mb-3">Chi tiết sản phẩm</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Ảnh</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selectedDonHang->chiTietDonHangs as $chiTiet)
                                                    <tr>
                                                        <td>
                                                            {{ $chiTiet->ten_san_pham_tai_thoi_diem ?? ($chiTiet->sanPham->ten ?? 'Sản phẩm không xác định') }}
                                                            @if ($chiTiet->bienTheSanPham)
                                                                <br>
                                                                <small class="text-muted">
                                                                    @if ($chiTiet->bienTheSanPham->ram)
                                                                        RAM:
                                                                        {{ $chiTiet->bienTheSanPham->ram->dung_luong }}
                                                                    @endif
                                                                    @if ($chiTiet->bienTheSanPham->ram && $chiTiet->bienTheSanPham->oCung)
                                                                        |
                                                                    @endif
                                                                    @if ($chiTiet->bienTheSanPham->oCung)
                                                                        Ổ cứng:
                                                                        {{ $chiTiet->bienTheSanPham->oCung->dung_luong }}
                                                                    @endif
                                                                </small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($chiTiet->sanPham->anh_dai_dien)
                                                                <img src="{{ asset('storage/' . $chiTiet->sanPham->anh_dai_dien) }}"
                                                                    alt="{{ $chiTiet->ten_san_pham_tai_thoi_diem }}"
                                                                    class="img-thumbnail"
                                                                    style="width: 50px; height: 50px;"
                                                                    onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                                                            @else
                                                                <span class="text-muted">Không có hình ảnh</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $chiTiet->so_luong }}</td>
                                                        <td>{{ number_format($chiTiet->don_gia, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('client.profile.show', ['tab' => 'orders']) }}"
                                        class="btn btn-primary btn-sm mt-3">Quay lại danh sách</a>
                                @else
                                    <!-- Danh sách đơn hàng -->
                                    @if ($donHangs->count() == 0)
                                        <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Mã đơn</th>
                                                        <th>Ngày đặt</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Phương thức thanh toán</th>
                                                        <th>Trạng thái</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($donHangs as $order)
                                                        <tr>
                                                            <td>{{ $order->ma_don }}</td>
                                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }} VNĐ
                                                            </td>
                                                            <td>
                                                                @if ($order->phuongThucThanhToan)
                                                                    {{ $order->phuongThucThanhToan->ten }}
                                                                @else
                                                                    <span class="text-muted">Không xác định</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @switch($order->trang_thai)
                                                                    @case('cho_xac_nhan')
                                                                        <span class="badge bg-secondary">Chờ xác nhận</span>
                                                                    @break

                                                                    @case('cho_thanh_toan')
                                                                        <span class="badge bg-info">Chờ thanh toán</span>
                                                                    @break

                                                                    @case('da_xac_nhan')
                                                                        <span class="badge bg-success">Đã xác nhận</span>
                                                                    @break

                                                                    @case('chuan_bi_hang')
                                                                        <span class="badge bg-warning">Chuẩn bị hàng</span>
                                                                    @break

                                                                    @case('dang_giao_hang')
                                                                        <span class="badge bg-primary">Đang giao hàng</span>
                                                                    @break

                                                                    @case('giao_thanh_cong')
                                                                        <span class="badge bg-success">Giao thành công</span>
                                                                    @break

                                                                    @case('giao_that_bai')
                                                                        <span class="badge bg-danger">Giao thất bại</span>
                                                                    @break

                                                                    @case('hoan_thanh')
                                                                        <span class="badge bg-success">Hoàn thành</span>
                                                                    @break

                                                                    @case('da_hoan_tien')
                                                                        <span class="badge bg-info">Đã hoàn tiền</span>
                                                                    @break

                                                                    @case('da_huy')
                                                                        <span class="badge bg-danger">Đã hủy</span>
                                                                    @break

                                                                    @case('yeu_cau_hoan_tra')
                                                                        <span class="badge bg-dark">Yêu cầu hoàn trả</span>
                                                                    @break

                                                                    @default
                                                                        <span class="badge bg-secondary">Không xác định</span>
                                                                @endswitch
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('client.orders.show', $order->id) }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i> Chi tiết
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $donHangs->links() }}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            body {
                background-color: #f8f9fa;
                font-family: "Quicksand", sans-serif;
                font-optical-sizing: auto;
                font-weight: normal;
                font-style: normal;
            }

            .container {
                max-width: 1200px;
            }

            .nav-tabs {
                border-bottom: 2px solid #e9ecef;
                gap: 10px;
                padding-bottom: 2px;
            }

            .nav-link {
                background: transparent;
                border: none;
                color: #6c757d;
                padding: 12px 20px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
                border-radius: 8px 8px 0 0;
            }

            .nav-link:hover {
                background: #f8f9fa;
                color: #495057;
            }

            .nav-link.active {
                background: #007bff;
                color: white;
                border-bottom: 2px solid #007bff;
            }

            .card {
                border-radius: 12px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .card-header {
                padding: 15px 20px;
                border-radius: 12px 12px 0 0;
            }

            .card-body {
                padding: 20px;
            }

            .badge {
                font-size: 12px;
                padding: 6px 10px;
                border-radius: 4px;
            }

            .btn-sm {
                padding: 8px 12px;
                font-size: 14px;
                font-weight: 500;
                border-radius: 6px;
                transition: all 0.3s ease;
            }

            .btn-outline-primary {
                border-color: #007bff;
                color: #007bff;
            }

            .btn-outline-primary:hover {
                background: #007bff;
                color: white;
                transform: translateY(-1px);
            }

            .btn-outline-success {
                border-color: #28a745;
                color: #28a745;
            }

            .btn-outline-success:hover {
                background: #28a745;
                color: white;
                transform: translateY(-1px);
            }

            .btn-outline-danger {
                border-color: #dc3545;
                color: #dc3545;
            }

            .btn-outline-danger:hover {
                background: #dc3545;
                color: white;
                transform: translateY(-1px);
            }

            .btn-outline-warning {
                border-color: #ffc107;
                color: #ffc107;
            }

            .btn-outline-warning:hover {
                background: #ffc107;
                color: white;
                transform: translateY(-1px);
            }

            .table-responsive {
                border-radius: 8px;
                overflow: hidden;
            }

            .table {
                margin-bottom: 0;
            }

            .table th,
            .table td {
                vertical-align: middle;
                font-size: 14px;
            }

            .table th {
                background: #f8f9fa;
                color: #333;
                font-weight: 600;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .img-thumbnail {
                border-radius: 6px;
                border: 1px solid #e9ecef;
            }

            /* Toast styles (đồng bộ với trang sản phẩm) */
            .toast-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                pointer-events: none;
            }

            .toast {
                background: white;
                border-radius: 8px;
                margin-bottom: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateX(100%);
                transition: all 0.3s ease;
                pointer-events: auto;
                min-width: 300px;
                overflow: hidden;
            }

            .toast.success {
                border-left: 4px solid #28a745;
            }

            .toast.error {
                border-left: 4px solid #dc3545;
            }

            .toast.show {
                transform: translateX(0);
                animation: slideInRight 0.3s ease-out;
            }

            .toast-content {
                padding: 15px 20px;
                display: flex;
                align-items: center;
                gap: 10px;
                color: #333;
                font-size: 14px;
                position: relative;
            }

            .toast-close {
                background: none;
                border: none;
                color: #999;
                cursor: pointer;
                font-size: 12px;
                margin-left: auto;
                padding: 0;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                transition: all 0.2s ease;
            }

            .toast-close:hover {
                background: #f0f0f0;
                color: #666;
            }

            .toast::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                height: 3px;
                background: currentColor;
                opacity: 0.3;
                animation: progress 4s linear;
            }

            .card-address {
                background-color: #E60023;

            }

            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes progress {
                from {
                    width: 100%;
                }

                to {
                    width: 0%;
                }
            }

            /* Responsive */
            @media (max-width: 768px) {
                .nav-link {
                    font-size: 14px;
                    padding: 10px 15px;
                }

                .card-body {
                    padding: 15px;
                }

                .table th,
                .table td {
                    font-size: 13px;
                }

                .toast-container {
                    right: 10px;
                    left: 10px;
                    top: 10px;
                }

                .toast {
                    min-width: auto;
                    margin-bottom: 8px;
                }

                .toast-content {
                    padding: 12px 15px;
                    font-size: 13px;
                }

                #mobileTabDropdownMenu {
                    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
                    border-radius: 0 0 8px 8px;
                    background: #fff;
                }
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Kích hoạt tab
                let triggerEl = null;

                // Ưu tiên theo lỗi form
                @if ($errors->hasAny(['ho_ten', 'email', 'ten_dang_nhap']))
                    triggerEl = document.querySelector('#personal-info-tab');
                @endif

                @if ($errors->hasAny(['current_password', 'password', 'password_confirmation']))
                    triggerEl = document.querySelector('#password-tab');
                @endif

                @if ($errors->hasAny(['ten_nguoi_nhan', 'so_dien_thoai_nguoi_nhan', 'dia_chi_day_du', 'tinh_thanh_pho', 'phuong_xa']))
                    triggerEl = document.querySelector('#addresses-tab');
                @endif

                // Ưu tiên theo session
                @if (session('status') === 'profile-updated')
                    triggerEl = document.querySelector('#personal-info-tab');
                @elseif (session('status') === 'password-updated')
                    triggerEl = document.querySelector('#password-tab');
                @elseif (session('success') || session('error'))
                    triggerEl = document.querySelector('#addresses-tab');
                @elseif (isset($selectedDonHang))
                    triggerEl = document.querySelector('#orders-tab');
                @endif

                // Ưu tiên theo query string ?tab=orders
                if (!triggerEl) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const tabParam = urlParams.get('tab');
                    if (tabParam === 'orders') {
                        triggerEl = document.querySelector('#orders-tab');
                    }
                }

                // Mặc định
                if (!triggerEl) {
                    triggerEl = document.querySelector('#personal-info-tab');
                }

                const profileTabs = new bootstrap.Tab(triggerEl);
                profileTabs.show();

                // Tự động ẩn toast sau 4 giây
                setTimeout(() => {
                    document.querySelectorAll('.toast').forEach(toast => {
                        toast.classList.remove('show');
                        setTimeout(() => toast.remove(), 300);
                    });
                }, 4000);
            });

            function showProfileTab(tab) {
                // Map tên tab sang id đúng
                const tabMap = {
                    'personal-info': 'personal-info-tab',
                    'password-update': 'password-tab',
                    'addresses': 'addresses-tab',
                    'orders': 'orders-tab'
                };
                const tabId = tabMap[tab] || tab + '-tab';
                const tabEl = document.querySelector(`#${tabId}`);
                if (tabEl) {
                    const profileTabs = new bootstrap.Tab(tabEl);
                    profileTabs.show();
                }
            }

            function toggleMobileTabDropdown(forceClose = false) {
                const menu = document.getElementById('mobileTabDropdownMenu');
                if (forceClose) {
                    menu.style.display = 'none';
                    return;
                }
                menu.style.display = (menu.style.display === 'none' || !menu.style.display) ? 'block' : 'none';
            }

            // Đóng dropdown khi click ra ngoài
            document.addEventListener('click', function(event) {
                const menu = document.getElementById('mobileTabDropdownMenu');
                const button = document.getElementById('mobileTabDropdownBtn');
                if (!button.contains(event.target) && !menu.contains(event.target)) {
                    menu.style.display = 'none';
                }
            });
        </script>
    @endpush
@endsection
