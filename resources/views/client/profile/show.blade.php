{{-- resources/views/client/profile/show.blade.php --}}
@extends('client.layouts.app')
{{-- @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif --}}
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Các tab điều hướng --}}
                <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab"
                            data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info"
                            aria-selected="true">Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-update"
                            type="button" role="tab" aria-controls="password-update" aria-selected="false">Cập nhật mật
                            khẩu</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses"
                            type="button" role="tab" aria-controls="addresses" aria-selected="false">Địa chỉ của
                            tôi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders"
                            type="button" role="tab" aria-controls="orders" aria-selected="false">Đơn hàng</button>
                    </li>
                </ul>

                {{-- Hiển thị thông báo --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="tab-content" id="profileTabsContent">
                    {{-- Tab Thông tin cá nhân --}}
                    <div class="tab-pane fade show active" id="personal-info" role="tabpanel"
                        aria-labelledby="personal-info-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Cập Nhật Thông Tin Cá Nhân</h4>
                            </div>
                            <div class="card-body">
                                @include('client.profile.partials.update-personal-info-form')
                            </div>
                        </div>
                    </div>

                    {{-- Tab Cập nhật mật khẩu --}}
                    <div class="tab-pane fade" id="password-update" role="tabpanel" aria-labelledby="password-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-white">
                                <h4 class="mb-0">Thay Đổi Mật Khẩu</h4>
                            </div>
                            <div class="card-body">
                                @include('client.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    {{-- Tab Đơn hàng --}}
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-white">
                                <h4 class="mb-0">Đơn Hàng</h4>
                            </div>

                            <div class="card-body">
                                @if (isset($selectedDonHang))
                                    {{-- Hiển thị chi tiết đơn hàng --}}
                                    <h5>Chi tiết đơn hàng #{{ $selectedDonHang->ma_don }}</h5>
                                    <p><strong>Ngày đặt:</strong> {{ $selectedDonHang->created_at->format('d/m/Y H:i') }}
                                    </p>
                                    <p><strong>Tổng tiền:</strong>
                                        {{ number_format($selectedDonHang->tong_tien, 0, ',', '.') }} VNĐ</p>
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

                                            @default
                                                <span class="badge bg-secondary">Không xác định</span>
                                        @endswitch
                                    </p>
                                    <p><strong>Thao tác:</strong>
   <span id="cancel-form-box">
    @if (in_array($selectedDonHang->trang_thai, ['cho_xac_nhan', 'cho_thanh_toan']))
        <form action="{{ route('client.orders.cancel', $selectedDonHang->id) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="trang_thai_hien_tai" value="{{ $selectedDonHang->trang_thai }}">
            <button type="submit" class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                <i class="fas fa-times"></i> Hủy đơn hàng
            </button>
        </form>
    @endif
</span>


    @if($selectedDonHang->trang_thai == 'giao_thanh_cong' && \Carbon\Carbon::parse($selectedDonHang->created_at)->diffInDays(now()) <= 7)
        <form action="{{ route('client.orders.return', $selectedDonHang->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning"
                onclick="return confirm('Bạn muốn hoàn trả đơn hàng này?')">
                <i class="fas fa-undo"></i> Hoàn trả hàng
            </button>
        </form>
    @endif
</p>

                                    <p>
                                        <strong>Phương thức thanh toán:</strong>
                                        @if($selectedDonHang->phuongThucThanhToan)
                                            {{ $selectedDonHang->phuongThucThanhToan->ten }}
                                        @else
                                            <span class="text-muted">Không xác định</span>
                                        @endif
                                    </p>
                                    <h6>Chi tiết sản phẩm</h6>
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
                                                        @if($chiTiet->bienTheSanPham)
                                                            <br>
                                                            <small class="text-muted">
                                                                @if($chiTiet->bienTheSanPham->ram)
                                                                    RAM: {{ $chiTiet->bienTheSanPham->ram->dung_luong }}
                                                                @endif
                                                                @if($chiTiet->bienTheSanPham->ram && $chiTiet->bienTheSanPham->oCung)
                                                                    |
                                                                @endif
                                                                @if($chiTiet->bienTheSanPham->oCung)
                                                                    Ổ cứng: {{ $chiTiet->bienTheSanPham->oCung->dung_luong }}
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($chiTiet->sanPham->anh_dai_dien)
                                                            <img src="{{ asset('storage/' . $chiTiet->sanPham->anh_dai_dien) }}"
                                                                alt="{{ $chiTiet->ten_san_pham_tai_thoi_diem }}"
                                                                class="img-thumbnail" style="width: 50px; height: 50px;"
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

                                    <a href="{{ route('client.profile.show', ['tab' => 'orders']) }}"
                                        class="btn btn-primary btn-sm">Quay lại danh sách</a>
                                @else
                                    {{-- Hiển thị danh sách đơn hàng --}}
                                    @if ($donHangs->count() == 0)
                                        <p>Bạn chưa có đơn hàng nào.</p>
                                    @else
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Mã đơn hàng</th>
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
                                                        <td>{{ number_format($order->tong_tien, 0, ',', '.') }} VNĐ</td>
                                                        <td>
                                                            @if($order->phuongThucThanhToan)
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

                                                                @default
                                                                    <span class="badge bg-secondary">Không xác định</span>
                                                            @endswitch


                                                        </td>
                                                        <td>
                                                            <a href="{{ route('client.orders.show', $order->id) }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i> Xem chi tiết
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $donHangs->links() }}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Tab Địa chỉ của tôi --}}
                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <div class="card shadow-sm">
                            <div
                                class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Danh sách địa chỉ</h4>
                                <a href="{{ route('client.addresses.create') }}" class="btn btn-light btn-sm">Thêm địa
                                    chỉ mới</a>
                            </div>
                            <div class="card-body">
                                @if ($user->diaChiNguoiDungs->isEmpty())
                                    <p>Bạn chưa có địa chỉ nào. Hãy thêm một địa chỉ mới!</p>
                                @else
                                    <div class="list-group">
                                        @foreach ($user->diaChiNguoiDungs as $address)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="card-title">{{ $address->ten_nguoi_nhan }}</h6>
                                                            <p class="card-text mb-1">
                                                                <strong>Số điện thoại:</strong>
                                                                {{ $address->so_dien_thoai_nguoi_nhan }}
                                                            </p>
                                                            <p class="card-text mb-1">
                                                                <strong>Địa chỉ:</strong> {{ $address->dia_chi_day_du }},
                                                                {{ $address->phuong_xa }}, {{ $address->quan_huyen }},
                                                                {{ $address->tinh_thanh_pho }}
                                                            </p>
                                                            @if ($address->mac_dinh)
                                                                <span class="badge bg-success">Địa chỉ mặc định</span>
                                                            @endif
                                                        </div>
                                                        <div class="btn-group">
                                                            <a href="{{ route('client.addresses.edit', $address) }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if (!$address->mac_dinh)
                                                                <form
                                                                    action="{{ route('client.addresses.setDefault', $address) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-success">
                                                                        <i class="fas fa-star"></i>
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
                                                                        <i class="fas fa-trash"></i>
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
                </div>
            </div>
        </div>
    </div>

    {{-- Script để kích hoạt tab --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var triggerEl = null;

            // Ưu tiên theo lỗi form
            @if ($errors->hasAny(['ho_ten', 'email', 'ten_dang_nhap']))
                triggerEl = document.querySelector('#personal-info-tab');
            @endif

            @if ($errors->hasAny(['current_password', 'password', 'password_confirmation']))
                triggerEl = document.querySelector('#password-tab');
            @endif

            @if (
                $errors->hasAny([
                    'ten_nguoi_nhan',
                    'so_dien_thoai_nguoi_nhan',
                    'dia_chi_day_du',
                    'tinh_thanh_pho',
                    'quan_huyen',
                    'phuong_xa',
                ]))
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

            // Ưu tiên theo query string ?tab=orders (nếu chưa có triggerEl)
            if (triggerEl === null) {
                const urlParams = new URLSearchParams(window.location.search);
                const tabParam = urlParams.get('tab');
                if (tabParam === 'orders') {
                    triggerEl = document.querySelector('#orders-tab');
                }
            }

            // Mặc định nếu không có gì khớp
            if (triggerEl === null) {
                triggerEl = document.querySelector('#personal-info-tab');
            }

            const profileTabs = new bootstrap.Tab(triggerEl);
            profileTabs.show();
        });
        //ẩn nút hủy
       @isset($selectedDonHang)

        setInterval(() => {
            fetch(`/orders/{{ $selectedDonHang->id }}/status`)
                .then(res => res.json())
                .then(data => {
                    const cancelBox = document.getElementById('cancel-form-box');
                    if (!['cho_xac_nhan', 'cho_thanh_toan'].includes(data.trang_thai)) {
                        cancelBox?.remove(); // ẩn toàn bộ thẻ chứa nút hủy
                    }
                });
        }, 3000); // kiểm tra mỗi 3 giây

@endisset

    </script>

@endsection
