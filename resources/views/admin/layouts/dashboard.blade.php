@extends('admin.layouts.app')

@section('content')


<div class="container-fluid py-4">

  {{-- Tổng quan --}}
<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-dark">
            <div class="card bg-primary text-white shadow-sm rounded-3 hover-card">
                <div class="card-body">
                    <h5>Tổng khách hàng</h5>
                    <h3>{{ $tongKhachHang }}</h3>
                    <small>+{{ $khachMoiHomNay }} hôm nay</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.sanpham.index') }}" class="text-decoration-none text-dark">
            <div class="card bg-success text-white shadow-sm rounded-3 hover-card">
                <div class="card-body">
                    <h5>Tổng sản phẩm</h5>
                    <h3>{{ $tongSanPham }}</h3>
                    <small>+{{ $sanPhamMoiHomNay }} hôm nay</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.don-hang.index') }}" class="text-decoration-none text-dark">
            <div class="card bg-warning text-white shadow-sm rounded-3 hover-card">
                <div class="card-body">
                    <h5>Tổng đơn hàng</h5>
                    <h3>{{ $tongDonHang }}</h3>
                    <small>+{{ $donHangHomNay }} hôm nay</small>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Danh sách cần làm --}}
<div class="row mt-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'cho_xac_nhan']) }}" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm hover-card">
                <div class="card-body">
                    <h6 class="text-muted">Đơn chờ xác nhận</h6>
                    <h4>{{ $donChoXacNhan }}</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'hoan_tra']) }}" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm hover-card">
                <div class="card-body">
                    <h6 class="text-muted">Yêu cầu hoàn trả</h6>
                    <h4>{{ $yeuCauHoanTraChoDuyet }}</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'hoan_thanh']) }}" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm hover-card">
                <div class="card-body">
                    <h6 class="text-muted">Đơn hoàn thành</h6>
                    <h4>{{ $donHoanThanh }}</h4>
                </div>
            </div>
        </a>
    </div>
</div>


</div>
@endsection

@push('css')
<style>
.hover-card {
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
</style>
@endpush



