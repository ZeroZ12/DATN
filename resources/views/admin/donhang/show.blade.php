@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-bold">Chi tiết đơn hàng: #{{ $donHang->ma_don }}</h2>

        {{-- Thông tin đơn hàng --}}
        <div class="card mb-4">
            <div class="card-header bg-light fw-bold">Thông tin đơn hàng</div>
            <div class="card-body">
                <div class="row gy-2">
                    <div class="col-md-6"><strong>Khách hàng:</strong> {{ $donHang->user->ho_ten ?? '---' }}</div>
                    <div class="col-md-6"><strong>Địa chỉ nhận hàng:</strong>
                        {{ $donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }},
                        {{ $donHang->diaChiNguoiDung->phuong_xa ?? '---' }},
                        {{ $donHang->diaChiNguoiDung->quan_huyen ?? '---' }},
                        {{ $donHang->diaChiNguoiDung->tinh_thanh_pho ?? '---' }}
                    </div>
                    <div class="col-md-6"><strong>Phương thức thanh toán:</strong>
                        {{ $donHang->phuongThucThanhToan->ten ?? '---' }}</div>
                    <div class="col-md-6"><strong>Mã giảm giá:</strong> {{ $donHang->maGiamGia->ma ?? 'Không có.' }}</div>
                    <div class="col-md-6"><strong>Tổng tiền gốc:</strong> {{ number_format($donHang->tong_tien_goc, 0) }}đ
                    </div>
                    <div class="col-md-6"><strong>Giảm giá:</strong> {{ number_format($donHang->giam_gia, 0) }}đ</div>
                    <div class="col-md-6"><strong>Tổng tiền thanh toán:</strong>
                        <span class="text-danger fw-bold">{{ number_format($donHang->tong_tien, 0) }}đ</span>
                    </div>
                    <div class="col-md-6"><strong>Trạng thái:</strong>
                        <span class="badge status-{{ $donHang->trang_thai }}">
                            {{ App\Models\DonHang::getTenTrangThai($donHang->trang_thai) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Danh sách sản phẩm --}}
        <div class="card">
            <div class="card-header bg-light fw-bold">Danh sách sản phẩm</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donHang->chiTietDonHangs as $ct)
                                <tr>
                                    <td>
                                        @php
                                            $anh = $ct->bienTheSanPham->sanPham->anh_dai_dien ?? null;
                                        @endphp
                                        <img src="{{ $anh ? asset('storage/' . $anh) : 'https://via.placeholder.com/60' }}"
                                            alt="Ảnh" width="60" height="60" class="rounded border">
                                    </td>
                                    <td class="text-start">
                                        {{ $ct->ten_hien_thi }}
                                        <br>
                                        <small class="text-muted">
                                            Mã biến thể: {{$ct->bienTheSanPham->ma_bien_the  }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            RAM: {{ $ct->bienTheSanPham->ram->dung_luong ?? 'N/A' }} |
                                            Ổ cứng: {{ $ct->bienTheSanPham->oCung->dung_luong ?? 'N/A' }}
                                        </small>
                                    </td>
                                    <td class="text-center">{{ $ct->so_luong }}</td>
                                    <td>{{ number_format($ct->don_gia, 0) }}đ</td>
                                    <td>{{ number_format($ct->so_luong * $ct->don_gia, 0) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.don-hang.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>
@endsection

@push('css')
    <style>
        .badge {
            padding: 0.5em 0.75em;
            font-size: 0.875rem;
            border-radius: 0.5rem;
        }

        .status-cho_xac_nhan {
            background-color: #ffc107;
            color: #000;
        }

        .status-cho_thanh_toan {
            background-color: #17a2b8;
        }

        .status-da_xac_nhan {
            background-color: #0d6efd;
        }

        .status-chuan_bi_hang,
        .status-dang_giao_hang {
            background-color: #6c757d;
        }

        .status-giao_thanh_cong,
        .status-hoan_thanh {
            background-color: #28a745;
        }

        .status-giao_that_bai,
        .status-da_huy {
            background-color: #dc3545;
        }

        .status-yeu_cau_hoan_tra {
            background-color: #343a40;
        }

        .status-da_hoan_tien {
            background-color: #495057;
        }
    </style>
@endpush
