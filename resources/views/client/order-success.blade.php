@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
                    </div>
                    <h3 class="mb-3">Đặt hàng thành công!</h3>
                    <p class="text-muted mb-4">
                        Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.
                    </p>
                    <div class="order-info mb-4">
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
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('client.home') }}" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>
                            Về trang chủ
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>
                            Xem đơn hàng
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
</style>
@endpush
