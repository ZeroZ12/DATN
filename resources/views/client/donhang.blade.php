@extends('client.layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
    <div class="container py-4">

        {{-- Tabs lọc --}}
        @php
            $trangThaiHienThi = [
                null => 'Tất cả',
                'cho_thanh_toan' => 'Chờ thanh toán',
                'dang_giao_hang' => 'Đang giao hàng',
                'hoan_thanh' => 'Hoàn thành',
                'da_huy' => 'Đã hủy',
                'hoan_tra' => 'Trả hàng / Hoàn tiền',
            ];
        @endphp

        <ul class="nav nav-tabs mb-4">
            @foreach ($trangThaiHienThi as $key => $label)
                <li class="nav-item">
                    <a href="{{ route('client.orders.index', $key ? ['trang_thai' => $key] : []) }}"
                        class="nav-link {{ request('trang_thai') === $key ? 'active' : (request('trang_thai') === null && $key === null ? 'active' : '') }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Tìm kiếm --}}
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm theo tên shop, ID đơn hàng hoặc sản phẩm...">
        </div>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-xmark me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        {{-- Danh sách đơn hàng --}}
        @forelse ($donHangs as $donHang)
            @php
                $trangThai = $donHang->trang_thai;
                $ycht = $donHang->yeuCauHoanTra;
                $daQua3Ngay = \Carbon\Carbon::parse($donHang->updated_at)->diffInDays(now()) > 3;

                $style = [
                    'cho_xac_nhan' => ['text-muted', 'fa-clock'],
                    'cho_thanh_toan' => ['text-primary', 'fa-wallet'],
                    'da_xac_nhan' => ['text-success', 'fa-check-circle'],
                    'chuan_bi_hang' => ['text-warning', 'fa-box'],
                    'dang_giao_hang' => ['text-warning', 'fa-truck-fast'],
                    'giao_thanh_cong' => ['text-success', 'fa-truck'],
                    'giao_that_bai' => ['text-danger', 'fa-truck-arrow-right'],
                    'hoan_thanh' => ['text-purple', 'fa-circle-check'],
                    'da_huy' => ['text-danger', 'fa-times-circle'],
                ];

                $leftTrangThai = $trangThai === 'hoan_thanh' ? 'giao_thanh_cong' : $trangThai;
                $leftText = App\Models\DonHang::getTenTrangThai($leftTrangThai);
                $leftIcon = $style[$leftTrangThai][1] ?? 'fa-question-circle';
                $leftColor = $style[$leftTrangThai][0] ?? 'text-secondary';
            @endphp

            <div class="border rounded mb-4 p-3 bg-white shadow-sm">
                {{-- Header --}}
                <a href="{{ route('client.orders.show', $donHang->id) }}" class="text-decoration-none text-dark">
                    <div class="p-3 mb-4 border rounded hover-shadow">
                        {{-- Mã đơn hàng và trạng thái --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold">
                                <i class="fa-solid fa-store me-1"></i>Mã đơn: {{ $donHang->ma_don ?? '---' }}
                            </div>
                            <div class="d-flex align-items-center">
                                @if (!in_array($trangThai, ['da_huy']))
                                    <span class="{{ $leftColor }}">
                                        <i class="fa-solid {{ $leftIcon }}"></i> {{ $leftText }}
                                    </span>
                                @endif

                                @if ($trangThai === 'hoan_thanh')
                                    <span class="ms-3 fw-bold text-purple">HOÀN THÀNH</span>
                                @elseif ($trangThai === 'da_huy')
                                    <span class="ms-3 fw-bold text-danger">
                                        ĐÃ HỦY
                                        @if ($donHang->huy_boi === 'khach_hang')
                                            (bởi Khách hàng)
                                        @elseif ($donHang->huy_boi === 'admin')
                                            (bởi Admin)
                                        @elseif ($donHang->huy_boi === 'he_thong')
                                            (bởi Hệ thống)
                                        @else
                                            (---)
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Chi tiết sản phẩm --}}
                        @foreach ($donHang->chiTietDonHangs as $ct)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . $ct->sanPham->anh_dai_dien) }}" alt="ảnh"
                                    width="80" class="me-3 border rounded">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $ct->sanPham->ten ?? '---' }}</div>
                                    <div class="text-muted small">
                                        @if ($ct->bienTheSanPham)
                                            Mã biến thể: {{ $ct->bienTheSanPham->ma_bien_the ?? '---' }} |
                                            Ram: {{ $ct->bienTheSanPham->ram->dung_luong ?? '---' }} |
                                            Ổ cứng: {{ $ct->bienTheSanPham->oCung->loai ?? '---' }} -
                                            {{ $ct->bienTheSanPham->oCung->dung_luong ?? '---' }}
                                        @else
                                            Thương hiệu: {{ $ct->sanPham->thuongHieu->ten ?? '---' }}
                                        @endif
                                    </div>
                                    <div class="text-muted small">Số lượng: x{{ $ct->so_luong }}</div>
                                </div>
                                <div class="text-end fw-bold text-danger">
                                    @php
                                        $gia = $ct->bienTheSanPham->gia ?? $ct->sanPham->gia;
                                        $tong = $gia * $ct->so_luong;
                                    @endphp
                                    {{ number_format($tong, 0, ',', '.') }}₫
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </a>

                {{-- Footer --}}
 <div class="d-flex justify-content-between align-items-center border-top pt-3">
    <div>
        Hình thức thanh toán: {{ $donHang->phuongThucThanhToan->ten }} <br>
        Trạng thái thanh toán: {{ $donHang->tt_thanh_toan ? 'Đã thanh toán' : 'Chưa thanh toán' }}
    </div>

    <div class="text-end">
        <div class="mb-2">
            @if ($donHang->giam_gia > 0)
                <div>
                    Giảm giá:
                    <span class="text-success">-{{ number_format($donHang->giam_gia, 0, ',', '.') }}₫</span>
                </div>
            @endif
            Thành tiền:
            <span class="text-danger fw-bold">{{ number_format($donHang->tong_tien, 0, ',', '.') }}₫</span>

            {{-- Trạng thái hoàn trả (nếu có) --}}
            @if ($ycht)
                <div class="mt-1 small">
                    Hoàn trả:
                    <span class="badge bg-info text-dark">
                        {{ \App\Models\YeuCauHoanTra::getTenTrangThai($ycht->trang_thai) }}
                    </span>

                    @if ($ycht->trang_thai === 'da_hoan_tien' && $ycht->thoi_gian_hoan_tien)
                        <div class="small text-muted">
                            <i class="bi bi-clock"></i>
                            Hoàn tiền lúc:
                            {{ \Carbon\Carbon::parse($ycht->thoi_gian_hoan_tien)->format('H:i d/m/Y') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="btn-group">
            {{-- Hủy đơn --}}
            @if (in_array($trangThai, ['cho_xac_nhan', 'cho_thanh_toan']))
                <form action="{{ route('client.orders.cancel', $donHang->id) }}" method="POST"
                    class="me-2"
                    onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Hủy Đơn</button>
                </form>
            @endif

            {{-- Nút xác nhận đã nhận hàng --}}
            @if ($trangThai === 'giao_thanh_cong' && !$ycht)
                <form action="{{ route('client.orders.daNhanHang', $donHang->id) }}" method="POST"
                    class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Đã Nhận Hàng</button>
                </form>
            @endif

            {{-- Nút viết đánh giá --}}
            @foreach ($donHang->chiTietDonHangs as $ct)
                @php
                    $daDanhGia = \App\Models\DanhGiaSanPham::where('id_product', $ct->san_pham_id)
                        ->where('id_user', Auth::id())
                        ->exists();
                @endphp
                @if ($trangThai === 'hoan_thanh' && !$daDanhGia)
                    <a href="{{ route('client.reviews.create', ['productId' => $ct->sanPham->id]) }}"
                        class="btn btn-primary btn-sm me-2 custom-btn review-btn"
                        data-product-name="{{ $ct->sanPham->ten }}">
                        Viết đánh giá
                    </a>
                @elseif ($trangThai === 'hoan_thanh' && $daDanhGia)
                    <small class="text-muted">Đã gửi đánh giá</small>
                @endif
            @endforeach

    @php
    $laNgoaiLe = $trangThai === 'da_huy'
        && $donHang->huy_boi === 'admin'
        && $donHang->id_phuong_thuc_thanh_toan == 2
        && $donHang->tt_thanh_toan == 1;
@endphp

{{-- Nút "Tôi đã gửi trả hàng" --}}
@if ($ycht && $ycht->trang_thai === 'da_phe_duyet' && !$laNgoaiLe)
    <form action="{{ route('client.hoan-tra.trahang', $ycht->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm custom-btn">
            <i class="fa-solid fa-box-open me-1"></i> Tôi đã gửi trả hàng
        </button>
    </form>
@endif

{{-- Nút tạo yêu cầu hoàn trả / hoàn tiền --}}
@if (!$ycht && ($trangThai === 'giao_thanh_cong' || $laNgoaiLe))
    <a href="{{ route('client.hoan-tra.create', $donHang->id) }}" class="btn btn-warning btn-sm custom-btn">
        Trả Hàng / Hoàn Tiền
    </a>
@endif



        </div>
    </div>
</div>

            </div>
        @empty
            <div class="text-center text-muted">Không có đơn hàng nào.</div>
        @endforelse
    </div>
@endsection

@push('styles')
    <style>
        .custom-btn {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .custom-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-primary.custom-btn {
            background-color: #00b14f;
            border-color: #00b14f;
        }

        .btn-primary.custom-btn:hover {
            background-color: #009644;
            border-color: #009644;
        }

        .btn-warning.custom-btn {
            background-color: #ffaa00;
            border-color: #ffaa00;
        }

        .btn-warning.custom-btn:hover {
            background-color: #e59400;
            border-color: #e59400;
        }

        .alert-custom {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.classList.remove('show');
            });
        }, 5000);
    </script>
@endpush
