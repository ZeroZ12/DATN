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
            <div class="d-flex justify-content-between align-items-center mb-2">
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
                    <img src="{{ asset('storage/' . $ct->sanPham->anh_dai_dien) }}" alt="ảnh" width="80" class="me-3 border">
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $ct->sanPham->ten ?? '---' }}</div>
                        <div class="text-muted small">Mã biến thể: {{ $ct->bienTheSanPham->ma_bien_the ?? '---' }}</div>
                        <div class="text-muted small">Số lượng: x{{ $ct->so_luong }}</div>
                    </div>
                    <div class="text-end fw-bold text-danger">
                        {{ number_format($ct->bienTheSanPham->gia * $ct->so_luong, 0, ',', '.') }}₫
                    </div>
                </div>
            @endforeach

            {{-- Footer --}}
            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                <div>
                    Hình thức thanh toán: {{ $donHang->phuongThucThanhToan->ten }}
                    @if ($trangThai === 'hoan_thanh')
                        <div class="text-muted small">
                            Yêu cầu hoàn trả trước: <strong>{{ \Carbon\Carbon::parse($donHang->updated_at)->addDays(3)->format('d-m-Y') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="text-end">
                    <div class="mb-2">
                        @if ($donHang->giam_gia > 0)
                            <div>
                                Giảm giá: <span class="text-success">-{{ number_format($donHang->giam_gia, 0, ',', '.') }}₫</span>
                            </div>
                        @endif
                        Thành tiền: <span class="text-danger fw-bold">{{ number_format($donHang->tong_tien, 0, ',', '.') }}₫</span>
                    </div>

                    <div class="btn-group">
                        {{-- Hủy đơn --}}
                        @if (in_array($trangThai, ['cho_xac_nhan', 'cho_thanh_toan']))
                            <form action="{{ route('client.orders.cancel', $donHang->id) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                            </form>
                        @endif

                        {{-- Đã nhận hàng --}}
                        @if ($trangThai === 'giao_thanh_cong')
                            <form action="{{ route('client.orders.daNhanHang', $donHang->id) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-success">Đã Nhận Hàng</button>
                            </form>
                        @endif

                        {{-- Trả hàng / hoàn tiền --}}
                        @php
                            $coTheHoanTra = false;
                            $isOnline = $donHang->id_phuong_thuc_thanh_toan == 2;

                            // Nếu đơn hoàn thành và chưa quá 3 ngày
                            if ($trangThai === 'hoan_thanh' && !$daQua3Ngay) {
                                $coTheHoanTra = true;
                            }

                            // Nếu đơn hủy bởi admin và thanh toán online (không giới hạn thời gian)
                            if ($trangThai === 'da_huy' && $donHang->huy_boi === 'admin' && $isOnline) {
                                $coTheHoanTra = true;
                            }
                        @endphp

                        @if ($coTheHoanTra)
                            @if ($ycht)
                                @if ($ycht->trang_thai === 'da_phe_duyet')
                                    <form action="{{ route('client.hoan-tra.trahang', $ycht->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa-solid fa-box-open me-1"></i> Tôi đã gửi trả hàng
                                        </button>
                                    </form>
                                @else
                                    <div class="small text-muted">
                                        Hoàn trả:
                                        <span class="badge bg-info text-dark">
                                            {{ \App\Models\YeuCauHoanTra::getTenTrangThai($ycht->trang_thai) }}
                                        </span>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('client.hoan-tra.create', $donHang->id) }}"
                                   class="btn btn-outline-secondary">
                                    Trả Hàng / Hoàn Tiền
                                </a>
                            @endif
                        @elseif($trangThai === 'hoan_thanh' && $daQua3Ngay)
                            <div class="small text-muted fst-italic">
                                (Đã quá hạn yêu cầu hoàn trả)
                            </div>
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

@push('scripts')
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.classList.remove('show');
        });
    }, 5000);
</script>
@endpush
