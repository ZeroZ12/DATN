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
            <div class="col-md-6">
    <strong>Mã giảm giá:</strong> {{ $donHang->maGiamGia?->ma ?? 'Chưa áp dụng' }}
</div>
<div class="col-md-6">
    <strong>Trạng thái thanh toán:</strong>     {{ $donHang->tt_thanh_toan ? 'Đã thanh toán' : 'Chưa thanh toán' }}

</div>



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
    <div class="text-muted small mb-1">
        Giá gốc: <del>{{ number_format($donHang->tong_tien_goc, 0, ',', '.') }}₫</del>
        @if($donHang->giam_gia > 0)
            | Giảm giá: <span class="text-success">-{{ number_format($donHang->giam_gia, 0, ',', '.') }}₫</span>
        @else
            | <span class="text-muted">Chưa áp dụng mã giảm giá</span>
        @endif
    </div>

    <h5 class="fw-bold text-danger">
        <i class="fas fa-money-bill-wave me-1"></i>
        Tổng thanh toán: {{ number_format($donHang->tong_tien, 0, ',', '.') }}₫
    </h5>
</div>

    </div>
</div>

        {{-- Thông tin yêu cầu hoàn hàng --}}
        @if ($donHang->yeuCauHoanTra)
            @php
                $hoanTra = $donHang->yeuCauHoanTra;
                $tenPhuongThuc = match ($hoanTra->phuong_thuc_hoan_tien) {
                    'momo' => 'Ví điện tử Momo',
                    'bank_transfer' => 'Chuyển khoản ngân hàng',
                    default => 'Không xác định',
                };
                $canShowTime = in_array($hoanTra->trang_thai, ['da_phe_duyet', 'dang_van_chuyen_tra_hang', 'da_nhan_hang', 'da_hoan_tien']);
                $anhKhach = $hoanTra->anhMinhChung->where('loai', 'nguoi_dung');
                $anhAdmin = $hoanTra->anhMinhChung->where('loai', 'admin');
            @endphp

            <div class="card shadow-sm mb-4 border-warning">
                <div class="card-header bg-warning fw-bold">🔁 Yêu cầu hoàn hàng</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Mã yêu cầu:</strong> {{ $hoanTra->ma_hoan_tra }}</div>
                        <div class="col-md-6"><strong>Phương thức hoàn tiền:</strong> {{ $tenPhuongThuc }}</div>
                    </div>

                    @if ($hoanTra->phuong_thuc_hoan_tien === 'bank_transfer')
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Ngân hàng:</strong> {{ $hoanTra->ten_ngan_hang }}</div>
                            <div class="col-md-6"><strong>Số tài khoản:</strong> {{ $hoanTra->so_tai_khoan }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Chủ tài khoản:</strong> {{ $hoanTra->ten_chu_tai_khoan }}</div>
                        </div>
                    @elseif ($hoanTra->phuong_thuc_hoan_tien === 'momo')
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>SĐT Momo:</strong> {{ $hoanTra->so_tai_khoan }}</div>
                            <div class="col-md-6"><strong>Chủ tài khoản:</strong> {{ $hoanTra->ten_chu_tai_khoan }}</div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Lý do hoàn hàng:</strong>
                        <div class="border rounded p-2 bg-light">{{ $hoanTra->ly_do }}</div>
                    </div>

                    @if ($canShowTime)
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Thời gian trả hàng:</strong><br>
                                @if ($hoanTra->thoi_gian_tra_hang)
                                    {{ \Carbon\Carbon::parse($hoanTra->thoi_gian_tra_hang)->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-danger">❌ Chưa trả hàng</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <strong>Thời gian nhận tiền:</strong><br>
                                @if ($hoanTra->thoi_gian_nhan_tien)
                                    {{ \Carbon\Carbon::parse($hoanTra->thoi_gian_nhan_tien)->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-danger">❌ Chưa hoàn tiền</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Trạng thái hoàn hàng:</strong><br>
                            <span class="badge bg-info">{{ \App\Models\YeuCauHoanTra::getTenTrangThai($hoanTra->trang_thai) }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Thời gian yêu cầu:</strong><br>
                            {{ $hoanTra->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    @if ($anhKhach->count() || $anhAdmin->count())
                        <div class="mt-3">
                            <strong>Ảnh minh chứng:</strong>
                            @if ($anhKhach->count())
                                <div class="mt-2 mb-2">
                                    <div class="fw-semibold text-muted">📤 Từ khách hàng:</div>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        @foreach ($anhKhach as $anh)
                                            <img src="{{ asset($anh->duong_dan) }}" alt="Ảnh KH" width="140" class="rounded border">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if ($anhAdmin->count())
                                <div class="mt-3 mb-2">
                                    <div class="fw-semibold text-muted">🛠️ Bill hoàn tiền (Admin):</div>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        @foreach ($anhAdmin as $anh)
                                            <img src="{{ asset('storage/' . $anh->duong_dan) }}" alt="Ảnh Admin" width="140" class="rounded border border-primary">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
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
