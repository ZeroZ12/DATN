@extends('admin.layouts.app')

@section('title', 'Trang chủ Admin')
@section('content')
    <div class="container-fluid py-3">
        <div class="row mb-3" @if (request('filter_type') && (request('from') || request('day') || request('month') || request('year'))) style="display:none" @endif>
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
                        <a href="{{ route('admin.hoan-tra.index') }}" class="text-decoration-none text-dark flex-fill">
                            <div class="text-center py-2 hover-shadow">
                                <div class="fw-bold fs-4">{{ $HoanTra['cho_phe_duyet'] }}</div>
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
            <div class="col-md-8 mx-auto">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Phân Tích Bán Hàng</span>
                        <span class="badge bg-light text-dark">{{ date('H:i:s d-m-Y') }}</span>
                        <div class="d-flex align-items-center ms-auto">
                            <button class="btn btn-outline-primary btn-sm me-2" type="button" id="toggleFilterBtn">
                                <i class="bi bi-funnel"></i> Lọc
                            </button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Bộ lọc thời gian (ẩn/hiện) -->
                        <form method="GET" class="row g-2 align-items-end mb-4" id="filterForm" style="display:none">
                            <div class="col-auto">
                                <label for="filter_type" class="form-label mb-0">Kiểu lọc</label>
                                <select name="filter_type" id="filter_type" class="form-select">
                                    <option value="range"
                                        {{ request('filter_type', 'range') == 'range' ? 'selected' : '' }}>Khoảng thời gian
                                    </option>
                                    <option value="day" {{ request('filter_type') == 'day' ? 'selected' : '' }}>Theo
                                        ngày</option>
                                    <option value="month" {{ request('filter_type') == 'month' ? 'selected' : '' }}>Theo
                                        tháng</option>
                                    <option value="year" {{ request('filter_type') == 'year' ? 'selected' : '' }}>Theo
                                        năm</option>
                                </select>
                            </div>
                            <div class="col-auto filter-range" style="display: none;">
                                <label class="form-label mb-0">Từ ngày</label>
                                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                            </div>
                            <div class="col-auto filter-range" style="display: none;">
                                <label class="form-label mb-0">Đến ngày</label>
                                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                            </div>
                            <div class="col-auto filter-day" style="display: none;">
                                <label class="form-label mb-0">Ngày</label>
                                <input type="date" name="day" class="form-control" value="{{ request('day') }}">
                            </div>
                            <div class="col-auto filter-month" style="display: none;">
                                <label class="form-label mb-0">Tháng</label>
                                <input type="month" name="month" class="form-control" value="{{ request('month') }}">
                            </div>
                            <div class="col-auto filter-year" style="display: none;">
                                <label class="form-label mb-0">Năm</label>
                                <input type="number" name="year" class="form-control" min="2000" max="2100"
                                    value="{{ request('year', date('Y')) }}">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Lọc</button>
                            </div>
                        </form>
                        <script>
                            function updateFilterFields() {
                                const type = document.getElementById('filter_type').value;
                                document.querySelectorAll('.filter-range, .filter-day, .filter-month, .filter-year').forEach(el => el.style
                                    .display = 'none');
                                if (type === 'range') {
                                    document.querySelectorAll('.filter-range').forEach(el => el.style.display = 'block');
                                } else if (type === 'day') {
                                    document.querySelectorAll('.filter-day').forEach(el => el.style.display = 'block');
                                } else if (type === 'month') {
                                    document.querySelectorAll('.filter-month').forEach(el => el.style.display = 'block');
                                } else if (type === 'year') {
                                    document.querySelectorAll('.filter-year').forEach(el => el.style.display = 'block');
                                }
                            }
                            document.getElementById('filter_type').addEventListener('change', updateFilterFields);
                            window.addEventListener('DOMContentLoaded', updateFilterFields);
                            // Toggle filter form
                            document.getElementById('toggleFilterBtn').addEventListener('click', function() {
                                const form = document.getElementById('filterForm');
                                form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'flex' : 'none';
                            });
                        </script>
                        @if (request('filter_type') && (request('from') || request('day') || request('month') || request('year')))
                            <div class="row text-center mt-4">
                                <div class="col">
                                    @if (($doanhSoFilter ?? 0) > 0)
                                        <a href="{{ route('admin.don-hang.revenue-list', request()->all()) }}"
                                            class="text-decoration-none">
                                            <div class="fw-bold fs-6">{{ number_format($doanhSoFilter ?? 0) }} VNĐ</div>
                                            <div class="text-muted">
                                                @if (request('filter_type') == 'range')
                                                    Doanh số từ {{ request('from') }} đến {{ request('to') }}
                                                @elseif(request('filter_type') == 'day')
                                                    Doanh số ngày {{ request('day') }}
                                                @elseif(request('filter_type') == 'month')
                                                    Doanh số tháng {{ request('month') }}
                                                @elseif(request('filter_type') == 'year')
                                                    Doanh số năm {{ request('year', date('Y')) }}
                                                @endif
                                            </div>
                                        </a>
                                    @else
                                        <div class="fw-bold fs-6">0 VNĐ</div>
                                        <div class="text-muted">
                                            @if (request('filter_type') == 'range')
                                                Doanh số từ {{ request('from') }} đến {{ request('to') }}
                                            @elseif(request('filter_type') == 'day')
                                                Doanh số ngày {{ request('day') }}
                                            @elseif(request('filter_type') == 'month')
                                                Doanh số tháng {{ request('month') }}
                                            @elseif(request('filter_type') == 'year')
                                                Doanh số năm {{ request('year', date('Y')) }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row text-center">
                                <div class="col">
                                    <a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'day', 'day' => date('Y-m-d')]) }}"
                                        class="text-decoration-none">
                                        <div class="fw-bold fs-6">{{ number_format($doanhSoNgay) }} VNĐ</div>
                                        <div class="text-muted">Doanh số Hôm Nay</div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'month', 'month' => date('Y-m')]) }}"
                                        class="text-decoration-none">
                                        <div class="fw-bold fs-6">{{ number_format($doanhSoThang) }} VNĐ</div>
                                        <div class="text-muted">Doanh số Tháng Này</div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'year', 'year' => date('Y')]) }}"
                                        class="text-decoration-none">
                                        <div class="fw-bold fs-6">{{ number_format($doanhSoNam) }} VNĐ</div>
                                        <div class="text-muted">Doanh số Năm Nay</div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'range', 'from' => '2000-01-01', 'to' => date('Y-m-d')]) }}"
                                        class="text-decoration-none">
                                        <div class="fw-bold fs-6">{{ number_format($tongDoanhSo) }} VNĐ</div>
                                        <div class="text-muted">Tổng Doanh Số</div>
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                <img src="https://pcmarket.vn/media/lib/21-10-2024/pcgaminggir.jpg" alt="promo"
                                    width="40" class="me-2">
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
                            <div class="small text-secondary">Hôm Nay {{ date('d-m-Y') }}</div>
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
