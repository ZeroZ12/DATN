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

                    @if($donHang->phuong_thuc_thanh_toan === 'banking')
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
                    @elseif($donHang->phuong_thuc_thanh_toan === 'momo')
                    <div class="payment-method mb-4">
                        <h6 class="mb-3">Thanh toán qua MoMo</h6>
                        <div class="text-center">
                            <img src="{{ asset('images/momo-qr.png') }}" alt="MoMo QR Code" class="img-fluid mb-3" style="max-width: 200px;">
                            <p class="text-muted">Quét mã QR để thanh toán</p>
                        </div>
                    </div>
                    @endif

                    <div class="order-info mb-4">
                        <h6 class="mb-3">Thông tin đơn hàng</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Mã đơn hàng:</td>
                                        <td class="text-end">#{{ $donHang->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng tiền:</td>
                                        <td class="text-end text-danger fw-bold">{{ number_format($donHang->tong_tien) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td>Phương thức thanh toán:</td>
                                        <td class="text-end">
                                            @if($donHang->phuong_thuc_thanh_toan === 'cod')
                                                Thanh toán khi nhận hàng
                                            @elseif($donHang->phuong_thuc_thanh_toan === 'banking')
                                                Chuyển khoản ngân hàng
                                            @else
                                                Ví MoMo
                                            @endif
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
</style>
@endpush
