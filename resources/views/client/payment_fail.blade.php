@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 64px;"></i>
                    </div>
                    <h3 class="mb-3">Thanh toán thất bại hoặc bị hủy!</h3>
                    <p class="text-muted mb-4">
                        Rất tiếc, đơn hàng của bạn chưa được thanh toán thành công.
                    </p>
                    <div class="order-info mb-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Mã đơn hàng:</td>
                                        <td class="text-end">#{{ $donHang->ma_don }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng tiền:</td>
                                        <td class="text-end text-danger fw-bold">{{ number_format($donHang->tong_tien) }}₫</td>
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
                                    @endif
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
                                    <tr>
                                        <td>Phương thức thanh toán:</td>
                                        <td class="text-end">
                                            @if($donHang->phuongThucThanhToan)
                                                {{ $donHang->phuongThucThanhToan->ten }}
                                            @else
                                                <span class="text-muted">Không xác định</span>
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
                        <a href="{{ route('client.orders.index', ['order_id' => $donHang->id]) }}" class="btn btn-outline-primary">
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
