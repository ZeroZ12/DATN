@extends('client.layouts.app')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4 text-primary">🧾 Chi tiết đơn hàng: <span class="text-dark">{{ $donHang->ma_don }}</span></h4>

       {{-- Thông tin đơn hàng + Danh sách sản phẩm --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">📦 Thông tin đơn hàng</div>
    <div class="card-body">

        {{-- Thông tin khách hàng --}}
        <h6 class="text-primary fw-semibold mb-3">👤 Thông tin khách hàng</h6>
        <div class="row g-3">
            <div class="col-md-6"><strong>Người mua hàng:</strong> {{ $donHang->user->ho_ten ?? '---' }}</div>
            <div class="col-md-6"><strong>Email:</strong> {{ $donHang->user->email ?? '---' }}</div>
            <div class="col-md-6"><strong>Số điện thoại:</strong> {{ $donHang->user->so_dien_thoai ?? '---' }}</div>
            <div class="col-md-6"><strong>Địa chỉ giao hàng:</strong> {{ $donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }}, {{ $donHang->diaChiNguoiDung->phuong_xa_name ?? '---' }}, {{ $donHang->diaChiNguoiDung->tinh_thanh_pho_name ?? '---' }}</div>
        </div>

        <hr>

        {{-- Thông tin đơn hàng --}}
        <h6 class="text-primary fw-semibold mb-3">📋 Chi tiết đơn hàng</h6>
        <div class="row g-3">
            <div class="col-md-6"><strong>Mã đơn hàng:</strong> {{ $donHang->ma_don }}</div>
            <div class="col-md-6">
                <strong>Trạng thái:</strong>
                <span class="badge bg-primary">{{ App\Models\DonHang::getTenTrangThai($donHang->trang_thai) }}</span>
            </div>
            <div class="col-md-6"><strong>Phương thức thanh toán:</strong> {{ $donHang->phuongThucThanhToan->ten ?? '---' }}</div>
            <div class="col-md-6"><strong>Ngày đặt hàng:</strong> {{ $donHang->created_at->format('d/m/Y H:i') }}</div>
            <div class="col-md-6"><strong>Mã giảm giá:</strong></div>

        </div>

        <hr>

        {{-- Danh sách sản phẩm --}}
        <h6 class="text-primary fw-semibold mb-3">🖥️ Sản phẩm đã đặt</h6>
        @foreach ($donHang->chiTietDonHangs as $ct)
            <a href="{{ route('sanpham.show', $ct->sanPham->id) }}" class="text-decoration-none text-dark">
                <div class="d-flex align-items-center p-2 border rounded mb-3 hover-shadow">
                    <img src="{{ asset('storage/' . $ct->sanPham->anh_dai_dien) }}" alt="ảnh sản phẩm" width="80" class="me-3 border rounded">
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $ct->sanPham->ten ?? '---' }}</div>
                        @if ($ct->bienTheSanPham)
                            <div class="text-muted small">
                                Mã biến thể: {{ $ct->bienTheSanPham->ma_bien_the }} |
                                RAM: {{ $ct->bienTheSanPham->ram->dung_luong }} |
                                Ổ cứng: {{ $ct->bienTheSanPham->oCung->loai }} - {{ $ct->bienTheSanPham->oCung->dung_luong }}
                            </div>
                        @else
                            <div class="text-muted small">Thương hiệu: {{ $ct->sanPham->thuongHieu->ten ?? '---' }}</div>
                        @endif
                        <div class="text-muted small mt-1">Số lượng: <strong>x{{ $ct->so_luong }}</strong></div>
                    </div>
                    <div class="text-end fw-bold text-danger">
                        @php
                            $gia = $ct->bienTheSanPham->gia ?? $ct->sanPham->gia;
                            $tong = $gia * $ct->so_luong;
                        @endphp
                        {{ number_format($tong, 0, ',', '.') }}₫
                    </div>
                </div>
            </a>
        @endforeach

        <div class="text-end mt-3">
            <h5 class="fw-bold text-danger">
                <i class="fas fa-money-bill-wave me-1"></i>
                Tổng thanh toán: {{ number_format($donHang->tong_tien, 0, ',', '.') }}₫
            </h5>
        </div>
    </div>
</div>

   @php
    $showRefundInfo =$donHang->trang_thai == 'da_phe_duyet'||$donHang->trang_thai == 'dang_tra_hang'||$donHang->trang_thai == 'shop_da_nhan_hang'|| $donHang->trang_thai == 'cho_phe_duyet'||$donHang->trang_thai == 'yeu_cau_hoan_tra'||$donHang->trang_thai == 'hoan_thanh' || $donHang->trang_thai == 'da_hoan_tien' || $donHang->tu_choi_hoan;
@endphp

@if($showRefundInfo)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-warning fw-bold">💰 Thông tin hoàn trả</div>
    <div class="card-body">
        <div class="row g-3">

            {{-- Trạng thái --}}
            @if($donHang->tu_choi_hoan==1)
                <div class="col-md-6">
                    <strong>Trạng thái hoàn trả:</strong>
                    <span class="badge bg-danger">❌ Yêu cầu hoàn trả bị từ chối</span>
                </div>
            @elseif($donHang->trang_thai == 'da_hoan_tien')
                <div class="col-md-6">
                    <strong>Trạng thái hoàn trả:</strong>
                    <span class="badge bg-success">✅ Hoàn tiền thành công</span>
                </div>
            @endif

            {{-- Lý do --}}
            <div class="col-md-6"><strong>Lý do:</strong> {{ $donHang->ly_do ?? '---' }}</div>

            {{-- Thông tin hoàn tiền --}}
            @if($donHang->phuong_thuc_hoan_tien)
                <div class="col-md-6">
                    <strong>Phương thức hoàn tiền:</strong>
                    {{ $donHang->phuong_thuc_hoan_tien == 'momo' ? 'Momo' : 'Chuyển khoản ngân hàng' }}
                </div>

                @if($donHang->phuong_thuc_hoan_tien !== 'momo')
                    <div class="col-md-6"><strong>Ngân hàng:</strong> {{ $donHang->ten_ngan_hang ?? '---' }}</div>
                @endif

                <div class="col-md-6"><strong>Số tài khoản/Momo:</strong> {{ $donHang->so_tai_khoan ?? '---' }}</div>
            @endif

            {{-- Ảnh minh chứng --}}
            <div class="col-12 mt-3">
                <strong>Ảnh minh chứng:</strong>
                <div class="row g-2 mt-2">

                    @if($donHang->trang_thai == 'da_huy')
                        {{-- Người dùng --}}
                        <div class="col-12">
                            <span class="fw-bold text-info">📷 Người dùng:</span>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @forelse($donHang->anhMinhChungs->where('loai', 'nguoi_dung') as $anh)
                                    <a href="{{ asset('storage/' . $anh->duong_dan) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                                             class="img-thumbnail" style="max-height: 120px;">
                                    </a>
                                @empty
                                    <span class="text-muted">Không có ảnh.</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Shop --}}
                        <div class="col-12 mt-3">
                            <span class="fw-bold text-success">📷 Ảnh minh chứng shop hoàn tiền:</span>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @forelse($donHang->anhMinhChungs->where('loai', 'shop') as $anh)
                                    <a href="{{ asset('storage/' . $anh->duong_dan) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                                             class="img-thumbnail" style="max-height: 120px;">
                                    </a>
                                @empty
                                    <span class="text-muted">Không có ảnh.</span>
                                @endforelse
                            </div>
                        </div>

                    @else
                        {{-- Chỉ hiện ảnh người dùng --}}
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            @forelse($donHang->anhMinhChungs->where('loai', 'nguoi_dung') as $anh)
                                <a href="{{ asset('storage/' . $anh->duong_dan) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                                         class="img-thumbnail" style="max-height: 120px;">
                                </a>
                            @empty
                                <span class="text-muted">Chưa có ảnh minh chứng.</span>
                            @endforelse
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endif


       <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('client.orders.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

    </div>
@endsection
