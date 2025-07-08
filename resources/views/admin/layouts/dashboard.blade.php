@extends('admin.layouts.app')

@section('title', 'Trang chủ Admin')
@section('content')
    <div class="container-fluid py-3">
        <div class="row mb-3">
            <!-- Danh sách cần làm -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Danh sách cần làm</div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'cho_xac_nhan']) }}"
                            class="text-decoration-none text-dark flex-fill">
                            <div class="text-center py-2 hover-shadow">
                                <div class="fw-bold fs-4">{{ $thongKe['cho_xac_nhan'] }}</div>
                                <div>Chờ Xác Nhận</div>
                            </div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'yeu_cau_hoan_tra']) }}"
                            class="text-decoration-none text-dark flex-fill">
                            <div class="text-center py-2 hover-shadow">
                                <div class="fw-bold fs-4">{{ $thongKe['yeu_cau_hoan_tra'] }}</div>
                                <div>Yêu Cầu Hoàn Trả</div>
                            </div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'da_hoan_tien']) }}"
                            class="text-decoration-none text-dark flex-fill">
                            <div class="text-center py-2 hover-shadow">
                                <div class="fw-bold fs-4">{{ $thongKe['da_hoan_tien'] }}</div>
                                <div>Đơn Đã Hoàn Tiền</div>
                            </div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'hoan_thanh']) }}"
                            class="text-decoration-none text-dark flex-fill">
                            <div class="text-center py-2 hover-shadow">
                                <div class="fw-bold fs-4">{{ $thongKe['hoan_thanh'] }}</div>
                                <div>Đơn Hoàn Thành</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Hiệu quả bán hàng -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Hiệu quả bán hàng</div>
                    <div class="card-body">
                        <div class="fw-bold text-success">Xuất sắc</div>
                        <div class="text-muted">Tất cả chỉ số đều tốt!</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Phân tích bán hàng -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Phân Tích Bán Hàng</span>
                        <span class="badge bg-light text-dark">{{ date('H:i:s d-m-Y') }}</span>
                        <a href="#" class="ms-auto small">Xem thêm</a>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <div class="fw-bold fs-6">{{ number_format($doanhSoNgay) }} VNĐ</div>
                                <div class="text-muted">Doanh số Hôm Nay</div>
                                
                            </div>
                            <div class="col">
                                <div class="fw-bold fs-6">{{ number_format($doanhSoThang) }} VNĐ</div>
                                <div class="text-muted">Doanh số Tháng Này</div>
                                
                            </div>
                            <div class="col">
                                <div class="fw-bold fs-6">{{ number_format($doanhSoNam) }} VNĐ</div>
                                <div class="text-muted">Doanh số Năm Nay</div>
                                
                            </div>
                            <div class="col">
                                <div class="fw-bold fs-6">{{ number_format($tongDoanhSo) }} VNĐ</div>
                                <div class="text-muted">Tổng Doanh Số</div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Quảng cáo Top PC -->
                <div class="card">
                    <div class="card-header fw-bold">Quảng cáo Top PC</div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-megaphone-fill me-2"></i>
                            Tối đa hóa doanh số bán hàng của bạn với Quảng cáo Top PC!
                            <a href="#" class="ms-2">Tìm hiểu thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tin nổi bật -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>Tin Nổi Bật</span>
                        <a href="#" class="small">Xem thêm</a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://pcmarket.vn/media/lib/21-10-2024/pcgaminggir.jpg"
                                    alt="promo" width="40" class="me-2">
                                <span class="fw-bold text-warning">BỨC PHÁ DOANH THU KHÔNG LO VỀ GIÁ</span>
                            </div>
                            <div class="small text-muted">Nhận đến 250.000 đồng cho người bán mới dùng tiếp thị liên kết
                            </div>
                            <a href="#" class="btn btn-sm btn-warning mt-2">Nhận ưu đãi ngay</a>
                        </div>
                        <hr>
                        <div>
                            <span class="fw-bold text-danger">Giải đáp thắc mắc về việc khấu trừ thuế</span>
                            <div class="small text-muted">
                                Shop cần làm gì ở giai đoạn chuyển tiếp trước và sau ngày 01/07/2025? Có cần cập nhật mã số
                                thuế đối 888 lên TopPC không? Giải đáp ngắn gọn - đi vào vấn đề tại đây 👉
                            </div>
                            <div class="small text-secondary">Hôm Nay {{date('d-m-Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .hover-shadow:hover {
        background: #f8f9fa;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        transition: 0.2s;
    }
</style>
