@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 mt-2 fw-bold">Chi tiết yêu cầu hoàn trả</h2>

        {{-- Grid 2 cột: Thông tin đơn hàng + Tài khoản --}}
        <div class="row g-4 mb-4">
            {{-- Thông tin đơn hàng --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Thông tin đơn hàng
                    </div>
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong>
                            <a href="{{ route('admin.don-hang.show', $hoanTra->donHang->id) }}">
                                {{ $hoanTra->donHang->ma_don }}
                            </a>
                        </p>
                        <p><strong>Phương thức thanh toán:</strong>
                            {{ $hoanTra->donHang->phuongThucThanhToan->ten ?? '---' }}</p>
                        <p><strong>Khách hàng:</strong> {{ $hoanTra->donHang->user->ho_ten ?? '---' }}</p>
                        <p><strong>SĐT:</strong> {{ $hoanTra->sdt_lien_he }}</p>
                        <p><strong>Tổng tiền:</strong> <span
                                style="color: red">{{ number_format($hoanTra->donHang->tong_tien, 0) }}đ </span></p>
                        <p><strong>Địa chỉ giao hàng:</strong>{{ $hoanTra->donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }},
                            {{ $hoanTra->donHang->diaChiNguoiDung->phuong_xa ?? '---' }},
                            {{ $hoanTra->donHang->diaChiNguoiDung->quan_huyen ?? '---' }},
                            {{ $hoanTra->donHang->diaChiNguoiDung->tinh_thanh_pho ?? '---' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tài khoản nhận hoàn tiền --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Tài khoản nhận hoàn tiền
                    </div>
                    <div class="card-body">
                        @php
                            $tenPhuongThuc = match ($hoanTra->phuong_thuc_hoan_tien) {
                                'momo' => 'Ví điện tử Momo',
                                'bank_transfer' => 'Chuyển khoản ngân hàng',
                                default => 'Không xác định',
                            };
                        @endphp
                        <p><strong>Phương thức:</strong> {{ $tenPhuongThuc }}</p>

                        @if ($hoanTra->phuong_thuc_hoan_tien === 'bank_transfer')
                            <p><strong>Ngân hàng:</strong><span style="color:blue">{{ $hoanTra->ten_ngan_hang ?? '---' }}</span>
                            </p>
                        @endif

                        <p><strong>Số TK / SĐT Momo:</strong> <span style="color: blue">{{ $hoanTra->so_tai_khoan }}</span>
                        </p>
                        <p><strong>Chủ tài khoản:</strong> {{ $hoanTra->ten_chu_tai_khoan }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trạng thái + lý do hoàn trả --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Thông tin hoàn trả
            </div>
            <div class="card-body">
                <p><strong>Mã hoàn trả:</strong> {{ $hoanTra->ma_hoan_tra }}</p>
                <p><strong>Trạng thái:</strong>
                    <span class="badge status-{{ $hoanTra->trang_thai }}">
                        {{ \App\Models\YeuCauHoanTra::getTenTrangThai($hoanTra->trang_thai) }}
                    </span>
                </p>
                <p><strong>Lý do hoàn trả: </strong>{{ $hoanTra->ly_do }}</p>
            </div>
        </div>

        {{-- Danh sách sản phẩm --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Sản phẩm trong đơn hàng
            </div>
            <div class="card-body">
                @foreach ($hoanTra->donHang->chiTietDonHangs as $item)
                    <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                        <img src="{{ asset('storage/' . $item->sanPham->anh_dai_dien) }}" width="60" height="60"
                            class="rounded me-3" style="object-fit: cover;">
                        <div class="flex-grow-1">
                            <div><strong>{{ $item->sanPham->ten ?? '---' }}</strong></div>
                            <div class="text-muted small">Biến thể: {{ $item->bienTheSanPham->ma_bien_the ?? '---' }}</div>
                        </div>
                        <div class="text-end" style="white-space: nowrap;">
                            <div>SL: x{{ $item->so_luong }}</div>
                            <div>Giá: {{ number_format($item->don_gia, 0) }}đ</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('admin.don-hang.index')}}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
        @php
    $trangThai = $hoanTra->trang_thai;
@endphp

@if ($trangThai === 'cho_phe_duyet')
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="da_phe_duyet">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Phê duyệt</button>
    </form>
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="tu_choi">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-danger">Từ chối</button>
    </form>



@elseif ($trangThai === 'dang_van_chuyen_tra_hang')
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="da_nhan_hang">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-info">Đã nhận hàng</button>
    </form>

@elseif ($trangThai === 'da_nhan_hang')
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="da_hoan_tien">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Hoàn tiền</button>
    </form>
@endif

    </div>
@endsection

@push('css')
    <style>
        .status-cho_phe_duyet {
            background-color: #ffc107;
        }

        .status-da_phe_duyet {
            background-color: #0d6efd;
        }

        .status-tu_choi {
            background-color: #dc3545;
        }

        .status-dang_van_chuyen_tra_hang {
            background-color: #6c757d;
        }

        .status-da_nhan_hang {
            background-color: #20c997;
        }

        .status-da_hoan_tien {
            background-color: #198754;
        }

        .status-chua_hoan_tra {
            background-color: #adb5bd;
        }

        .badge {
            color: white !important;
            font-size: 0.85rem;
            padding: 0.45em 0.75em;
        }
    </style>
@endpush
