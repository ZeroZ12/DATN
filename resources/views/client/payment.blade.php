@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Thanh toán đơn hàng #{{ $donHang->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="text-success mb-3">
                            <i class="fas fa-check-circle"></i>
                            Đặt hàng thành công!
                        </h4>
                        <p class="text-muted">Vui lòng chọn phương thức thanh toán phù hợp</p>
                    </div>

                    @if($donHang->phuongThucThanhToan->id === 2)
                    <div class="payment-method mb-4">
                        <h6 class="mb-3">Thông tin chuyển khoản</h6>
                        <div class="bank-info p-3 bg-light rounded">
                            <p class="mb-2"><strong>Ngân hàng:</strong> Vietcombank</p>
                            <p class="mb-2"><strong>Số tài khoản:</strong> 1234567890</p>
                            <p class="mb-2"><strong>Chủ tài khoản:</strong> CÔNG TY TNHH ABC</p>
                            <p class="mb-2"><strong>Số tiền:</strong> {{ number_format($donHang->tong_tien) }}₫</p>
                            <p class="mb-0"><strong>Nội dung chuyển khoản:</strong> THANHTOAN {{ $donHang->id }}</p>
                        </div>
                    </div>
                    @elseif($donHang->phuongThucThanhToan->id === 3)
                    <div class="payment-method mb-4">
                        <h6 class="mb-3">Thanh toán qua MoMo</h6>
                        <div class="text-center">
                            <img src="{{ asset('images/momo-qr.png') }}" alt="MoMo QR Code" class="img-fluid mb-3" style="max-width: 200px;">
                            <p class="text-muted">Quét mã QR để thanh toán</p>
                        </div>
                    </div>
                    @elseif($donHang->phuongThucThanhToan->id === 4)
                    <div class="payment-method mb-4">
                        <h6 class="mb-3">Thanh toán qua thẻ tín dụng</h6>
                        <div class="text-center">
                            <p class="text-muted">Vui lòng thanh toán tại cửa hàng</p>
                        </div>
                    </div>
                    @else
                    <div class="payment-method mb-4">
                        <h6 class="mb-3">Thanh toán khi nhận hàng</h6>
                        <div class="text-center">
                            <p class="text-muted">Bạn sẽ thanh toán khi nhận được hàng</p>
                        </div>
                    </div>
                    @endif

                    <!-- Thông tin sản phẩm -->
                    <div class="order-items mb-4">
                        <h6 class="mb-3">Sản phẩm đã đặt</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Đơn giá</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donHang->chiTietDonHangs as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="{{ asset('storage/' . ($item->bienTheSanPham->anh_dai_dien ?? $item->sanPham->anh_dai_dien ?? 'images/no-image.png')) }}"
                                                         alt="{{ $item->ten_hien_thi }}"
                                                         class="img-thumbnail"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ $item->ten_hien_thi }}</h6>
                                                    @if($item->bienTheSanPham)
                                                    <small class="text-muted">
                                                        RAM: {{ $item->bienTheSanPham->ram->ten ?? 'N/A' }} |
                                                        Ổ cứng: {{ $item->bienTheSanPham->oCung->ten ?? 'N/A' }}
                                                    </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->so_luong }}</td>
                                        <td class="text-end">{{ number_format($item->don_gia) }}₫</td>
                                        <td class="text-end">{{ number_format($item->don_gia * $item->so_luong) }}₫</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="order-info mb-4">
                        <h6 class="mb-3">Thông tin đơn hàng</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Mã đơn hàng:</td>
                                        <td class="text-end">#{{ $donHang->id }}</td>
                                    </tr>
                                    @if($donHang->giam_gia > 0)
                                    <tr>
                                        <td>Tổng tiền gốc:</td>
                                        <td class="text-end text-muted text-decoration-line-through">{{ number_format($donHang->tong_tien_goc) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td>Giảm giá:</td>
                                        <td class="text-end text-success">-{{ number_format($donHang->giam_gia) }}₫</td>
                                    </tr>
                                    @if($donHang->maGiamGia)
                                    <tr>
                                        <td>Mã giảm giá:</td>
                                        <td class="text-end text-success">
                                            {{ $donHang->maGiamGia->ma }}
                                            @if($donHang->maGiamGia->loai == 'phan_tram')
                                                (Giảm {{ $donHang->maGiamGia->gia_tri }}%)
                                            @else
                                                (Giảm {{ number_format($donHang->maGiamGia->gia_tri) }}₫)
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endif
                                    <tr>
                                        <td>Tổng tiền:</td>
                                        <td class="text-end text-danger fw-bold">{{ number_format($donHang->tong_tien) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td>Phương thức thanh toán:</td>
                                        <td class="text-end">
                                            {{ $donHang->phuongThucThanhToan->ten }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('client.order.success', $donHang->id) }}" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>
                            Xác nhận đã thanh toán
                        </a>
                        <a href="{{ route('client.home') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-home me-2"></i>
                            Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    .card-header {
        border-bottom: 1px solid #eee;
        padding: 1rem;
    }
    .bank-info {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }
    .order-items .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
</style>
@endpush
