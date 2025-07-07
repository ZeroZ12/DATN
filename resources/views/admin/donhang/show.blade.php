@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <h2 class="title">Chi tiết đơn hàng: {{ $donHang->ma_don }}</h2>

        {{-- Thông tin đơn hàng --}}
        <div class="order-info">
            <div><strong>Khách hàng:</strong> {{ $donHang->user->ho_ten ?? '---' }}</div>
            <div><strong>Địa chỉ nhận hàng:</strong> {{ $donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }}</div>
            <div><strong>Phương thức thanh toán:</strong> {{ $donHang->phuongThucThanhToan->ten ?? '---' }}</div>
            <div><strong>Mã giảm giá:</strong> {{ $donHang->maGiamGia->ma ?? '---' }}</div>
            <div><strong>Tổng tiền gốc:</strong> {{ number_format($donHang->tong_tien_goc, 0) }}đ</div>
            <div><strong>Giảm giá:</strong> {{ number_format($donHang->giam_gia, 0) }}đ</div>
            <div><strong>Tổng tiền thanh toán:</strong> <span
                    class="total">{{ number_format($donHang->tong_tien, 0) }}đ</span></div>
            <div><strong>Trạng thái:</strong>
                <span class="status-badge status-{{ $donHang->trang_thai }}">
                    {{ App\Models\DonHang::getTenTrangThai($donHang->trang_thai) }}
                </span>
            </div>
        </div>

        {{-- Form cập nhật trạng thái --}}
        <div class="mt-4">
            
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}"
                class="d-flex align-items-center">
                @csrf
                @if ($donHang->trang_thai != 'da_hoan_tien' && $donHang->trang_thai != 'da_huy')
                <h4>Cập nhật trạng thái</h4>
                    <select name="trang_thai" class="status-select">
                        @foreach (App\Models\DonHang::TRANG_THAI as $trangThai)
                            <option value="{{ $trangThai }}"
                                {{ $donHang->trang_thai == $trangThai ? 'selected' : '' }}>
                                {{ App\Models\DonHang::getTenTrangThai($trangThai) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-update">Cập nhật</button>
                @else
                    <span><h4>Trạng Thái đơn hàng</h4></span>
                    <span><div class="badge badge-primary">{{ $donHang->trang_thai}}</div></span>
                @endif
            </form>
        </div>

        {{-- Danh sách sản phẩm --}}
        <h4 class="mt-4">Danh sách sản phẩm</h4>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donHang->chiTietDonHangs as $ct)
                        <tr>
                            <td>{{ $ct->ten_hien_thi }}</td>
                            <td>{{ $ct->so_luong }}</td>
                            <td>{{ number_format($ct->don_gia, 0) }}đ</td>
                            <td>{{ number_format($ct->so_luong * $ct->don_gia, 0) }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('css')
    <style>
        .title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .order-info div {
            margin-bottom: 8px;
        }

        .total {
            color: #dc3545;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            color: #fff;
            font-size: 0.9rem;
        }

        .status-cho_xac_nhan {
            background: #ffc107;
            color: #000;
        }

        .status-cho_thanh_toan {
            background: #17a2b8;
        }

        .status-da_xac_nhan {
            background: #007bff;
        }

        .status-chuan_bi_hang {
            background: #6c757d;
        }

        .status-dang_giao_hang {
            background: #6c757d;
        }

        .status-giao_thanh_cong {
            background: #28a745;
        }

        .status-giao_that_bai {
            background: #dc3545;
        }

        .status-hoan_thanh {
            background: #28a745;
        }

        .status-da_huy {
            background: #dc3545;
        }

        .status-yeu_cau_hoan_tra {
            background: #42463d;
        }

        .status-da_hoan_tien {
            background: #343a40;
        }

        .status-select {
            padding: 6px 12px;
            margin-right: 8px;
        }

        .btn-update {
            padding: 6px 16px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .btn-update:hover {
            background: #0056b3;
        }

        .table-container {
            overflow-x: auto;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .order-table thead {
            background: #f5f5f5;
            font-weight: bold;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }
    </style>
@endpush
