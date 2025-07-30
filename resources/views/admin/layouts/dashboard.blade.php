@extends('admin.layouts.app')

@section('title', 'Trang chủ Admin')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        {{-- Cột trái: Danh sách cần làm + Phân tích + Quảng cáo --}}
        <div class="col-md-8 d-flex flex-column gap-3">
            {{-- Danh sách cần làm --}}
            @if (!(request('filter_type') && (request('from') || request('day') || request('month') || request('year'))))
                <div class="card">
                    <div class="card-header fw-bold">Danh sách cần làm</div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'cho_xac_nhan']) }}" class="text-decoration-none text-dark flex-fill text-center hover-shadow py-2">
                            <div class="fw-bold fs-4">{{ $thongKe['cho_xac_nhan'] }}</div>
                            <div>Chờ Xác Nhận</div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.hoan-tra.index', ['trang_thai' => 'cho_phe_duyet']) }}" class="text-decoration-none text-dark flex-fill text-center hover-shadow py-2">
                            <div class="fw-bold fs-4">{{ $HoanTra['cho_phe_duyet'] }}</div>
                            <div>Yêu Cầu Hoàn Trả</div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.hoan-tra.index', ['trang_thai' => 'da_hoan_tien']) }}" class="text-decoration-none text-dark flex-fill text-center hover-shadow py-2">
                            <div class="fw-bold fs-4">{{ $HoanTra['da_hoan_tien'] }}</div>
                            <div>Đơn Đã Hoàn Tiền</div>
                        </a>
                        <div class="vr mx-3"></div>
                        <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'hoan_thanh']) }}" class="text-decoration-none text-dark flex-fill text-center hover-shadow py-2">
                            <div class="fw-bold fs-4">{{ $thongKe['hoan_thanh'] }}</div>
                            <div>Đơn Hoàn Thành</div>
                        </a>
                    </div>
                </div>
            @endif

            {{-- Phân tích bán hàng --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Phân Tích Bán Hàng</span>
                    <span class="badge bg-light text-dark">{{ date('H:i:s d-m-Y') }}</span>
                    <div class="d-flex align-items-center ms-auto">
                        <button class="btn btn-outline-primary btn-sm me-2" type="button" id="toggleFilterBtn"><i class="bi bi-funnel"></i> Lọc</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-2 align-items-end mb-4" id="filterForm" style="display:none">
                        <div class="col-auto">
                            <label for="filter_type" class="form-label mb-0">Kiểu lọc</label>
                            <select name="filter_type" id="filter_type" class="form-select">
                                <option value="range" {{ request('filter_type', 'range') == 'range' ? 'selected' : '' }}>Khoảng thời gian</option>
                                <option value="day" {{ request('filter_type') == 'day' ? 'selected' : '' }}>Theo ngày</option>
                                <option value="month" {{ request('filter_type') == 'month' ? 'selected' : '' }}>Theo tháng</option>
                                <option value="year" {{ request('filter_type') == 'year' ? 'selected' : '' }}>Theo năm</option>
                            </select>
                        </div>
                        <div class="col-auto filter-range"><label class="form-label mb-0">Từ ngày</label><input type="date" name="from" class="form-control" value="{{ request('from') }}"></div>
                        <div class="col-auto filter-range"><label class="form-label mb-0">Đến ngày</label><input type="date" name="to" class="form-control" value="{{ request('to') }}"></div>
                        <div class="col-auto filter-day"><label class="form-label mb-0">Ngày</label><input type="date" name="day" class="form-control" value="{{ request('day') }}"></div>
                        <div class="col-auto filter-month"><label class="form-label mb-0">Tháng</label><input type="month" name="month" class="form-control" value="{{ request('month') }}"></div>
                        <div class="col-auto filter-year"><label class="form-label mb-0">Năm</label><input type="number" name="year" class="form-control" min="2000" max="2100" value="{{ request('year', date('Y')) }}"></div>
                        <div class="col-auto"><button class="btn btn-primary" type="submit">Lọc</button></div>
                    </form>

                    <script>
                        function updateFilterFields() {
                            const type = document.getElementById('filter_type').value;
                            document.querySelectorAll('.filter-range, .filter-day, .filter-month, .filter-year').forEach(el => el.style.display = 'none');
                            if (type === 'range') document.querySelectorAll('.filter-range').forEach(el => el.style.display = 'block');
                            else if (type === 'day') document.querySelectorAll('.filter-day').forEach(el => el.style.display = 'block');
                            else if (type === 'month') document.querySelectorAll('.filter-month').forEach(el => el.style.display = 'block');
                            else if (type === 'year') document.querySelectorAll('.filter-year').forEach(el => el.style.display = 'block');
                        }
                        document.getElementById('filter_type').addEventListener('change', updateFilterFields);
                        window.addEventListener('DOMContentLoaded', updateFilterFields);
                        document.getElementById('toggleFilterBtn').addEventListener('click', function () {
                            const form = document.getElementById('filterForm');
                            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'flex' : 'none';
                        });
                    </script>

                    {{-- Doanh số --}}
                    @if (request('filter_type') && (request('from') || request('day') || request('month') || request('year')))
                        <div class="row text-center mt-4">
                            <div class="col">
                                @if (($doanhSoFilter ?? 0) > 0)
                                    <a href="{{ route('admin.don-hang.revenue-list', request()->all()) }}" class="text-decoration-none">
                                        <div class="fw-bold fs-6">{{ number_format($doanhSoFilter ?? 0) }} VNĐ</div>
                                        <div class="text-muted">
                                            @switch(request('filter_type'))
                                                @case('range') Doanh số từ {{ request('from') }} đến {{ request('to') }} @break
                                                @case('day') Doanh số ngày {{ request('day') }} @break
                                                @case('month') Doanh số tháng {{ request('month') }} @break
                                                @case('year') Doanh số năm {{ request('year', date('Y')) }} @break
                                            @endswitch
                                        </div>
                                    </a>
                                @else
                                    <div class="fw-bold fs-6">0 VNĐ</div>
                                    <div class="text-muted">Không có dữ liệu</div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row text-center">
                            <div class="col"><a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'day', 'day' => date('Y-m-d')]) }}" class="text-decoration-none"><div class="fw-bold fs-6">{{ number_format($doanhSoNgay) }} VNĐ</div><div class="text-muted">Doanh số hôm nay</div></a></div>
                            <div class="col"><a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'month', 'month' => date('Y-m')]) }}" class="text-decoration-none"><div class="fw-bold fs-6">{{ number_format($doanhSoThang) }} VNĐ</div><div class="text-muted">Tháng này</div></a></div>
                            <div class="col"><a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'year', 'year' => date('Y')]) }}" class="text-decoration-none"><div class="fw-bold fs-6">{{ number_format($doanhSoNam) }} VNĐ</div><div class="text-muted">Năm nay</div></a></div>
                            <div class="col"><a href="{{ route('admin.don-hang.revenue-list', ['filter_type' => 'range', 'from' => '2000-01-01', 'to' => date('Y-m-d')]) }}" class="text-decoration-none"><div class="fw-bold fs-6">{{ number_format($tongDoanhSo) }} VNĐ</div><div class="text-muted">Tổng doanh số</div></a></div>
                        </div>
                    @endif
                </div>
            </div>

            @if (!empty($labels) && !empty($data))
    <hr>
    <canvas id="salesChart" height="100"></canvas>



@endif
<hr>
<canvas id="orderChart" height="100"></canvas>



   <div class="card">
    <div class="card-header fw-bold">15 đơn hàng hoàn thành gần nhất</div>
    <div class="card-body">
        <ul class="list-group">
            @forelse ($donHangHoanThanh as $don)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="flex-grow-1">
                            <div class="fw-bold">
                                {{ $don->ma_don }} &mdash; {{ $don->user->ho_ten ?? '---' }}
                                <small class="text-muted">({{ $don->user->email ?? '---' }})</small>
                            </div>
                            <div class="small text-muted">
                                {{ $don->created_at->format('d/m/Y H:i') }} |
                                {{ number_format($don->tong_tien) }} đ |
                                {{ $don->phuongThucThanhToan->ten ?? '---' }}
                            </div>
                        </div>
                        <a href="{{ route('admin.don-hang.show', $don->id) }}" class="btn btn-sm btn-outline-primary mt-2 mt-md-0">Xem</a>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-muted">Không có đơn hàng nào</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="card">
<div class="card-header fw-bold">
    📉 Sản phẩm sắp hết hàng
    <span class="text-muted ms-2">(Tổng: {{ $sanPhamSapHetHang->count() }} sản phẩm)</span>
</div>

    <div class="card-body">
        <ul class="list-group">
            @forelse ($sanPhamSapHetHang as $bienThe)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <div class="flex-grow-1 me-2">
                        <div><strong>{{ $bienThe->sanPham->ten ?? '---' }}</strong></div>
                        <div class="small text-muted">
                            Mã biến thể: {{ $bienThe->ma_bien_the ?? '---' }} |
                            @if ($bienThe->ram) RAM: {{ $bienThe->ram->dung_luong }} | @endif
                            @if ($bienThe->oCung) Ổ cứng: {{ $bienThe->oCung->loai }} - {{ $bienThe->oCung->dung_luong }} | @endif
                          <span style="color:red"> Còn lại: <strong>{{ $bienThe->ton_kho }}</strong> cái</span>
                        </div>
                    </div>
                   <a href="{{ route('admin.sanpham.bienthe.edit', [$bienThe->id_product, $bienThe->id]) }}" class="btn btn-sm btn-warning">Quản lý</a>

                </li>
            @empty
                <li class="list-group-item text-muted">Không có sản phẩm nào gần hết hàng</li>
            @endforelse
        </ul>
    </div>
</div>




            {{-- Quảng cáo --}}
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

        {{-- Cột phải: Xem nhiều + Bán chạy --}}
        <div class="col-md-4 d-flex flex-column gap-3">
            {{-- Sản phẩm được xem nhiều --}}
           <div class="card">
    <div class="card-header fw-bold text-center">🔥 Sản phẩm được xem nhiều</div>
    <div class="card-body">
        @if ($sanPhamXemNhieu->count() > 0)
            <div class="d-flex overflow-auto gap-3 pb-2 px-1">
                @foreach ($sanPhamXemNhieu as $sp)
                    <div class="card product-card border-0 shadow-sm" style="min-width: 240px;">
                        <img src="{{ asset('storage/'.$sp->anh_dai_dien) }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $sp->ten }}">
                        <div class="card-body p-3">
                            <h6 class="card-title text-truncate mb-1" title="{{ $sp->ten }}">{{ $sp->ten }}</h6>
                            <div class="small text-muted mb-1">Số lượt xem: {{ $sp->luot_xem }} lượt xem</div>
                            @if ($sp->gia_khuyen_mai ?? false)
                                <div class="fw-bold text-danger mb-2">{{ number_format($sp->gia_khuyen_mai) }} đ</div>
                            @endif
                            <a href="{{ route('sanpham.show', $sp->id) }}" class="btn btn-sm btn-outline-primary w-100">Xem sản phẩm</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Chưa có sản phẩm nào</p>
        @endif
    </div>
</div>




            {{-- Sản phẩm bán chạy --}}
            <div class="card">
                <div class="card-header fw-bold">Sản Phẩm Bán Chạy</div>
                <div class="card-body">
                    @forelse ($sanPhamBanChay as $sanPham)
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('storage/'.$sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten }}" width="100" class="me-2">
                                <span class="fw-bold text-dark">{{ $sanPham->ten }}</span>
                            </div>
                            <div class="small text-muted">Đã bán: {{ $sanPham->luot_mua }}</div>
                            <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn btn-sm btn-primary mt-2">Xem sản phẩm</a>
                        </div>
                        @if (!$loop->last) <hr> @endif
                    @empty
                        <p class="text-muted">Chưa có sản phẩm nào</p>
                    @endforelse
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
    .product-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 10px;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .product-card .btn:hover {
        background-color: #0d6efd;
        color: #fff;
    }

</style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Tạo gradient cho biểu đồ doanh số
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 300);
    salesGradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
    salesGradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

    const salesChart = new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Doanh số (VNĐ)',
                data: {!! json_encode($data) !!},
                backgroundColor: salesGradient,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 6, // Bo góc cột
                hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw;
                            return new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' đ';
                        },
                        font: { size: 12 }
                    }
                },
                x: {
                    ticks: {
                        font: { size: 12 }
                    }
                }
            }
        }
    });

    // Biểu đồ đơn hàng hoàn thành
    const orderCtx = document.getElementById('orderChart').getContext('2d');
    const orderGradient = orderCtx.createLinearGradient(0, 0, 0, 300);
    orderGradient.addColorStop(0, 'rgba(255, 99, 132, 0.4)');
    orderGradient.addColorStop(1, 'rgba(255, 99, 132, 0.1)');

    const orderChart = new Chart(orderCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Số đơn hàng hoàn thành',
                data: {!! json_encode($orderData) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: orderGradient,
                fill: true,
                tension: 0.4, // Độ cong của line
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' đơn';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: { size: 12 }
                    }
                },
                x: {
                    ticks: {
                        font: { size: 12 }
                    }
                }
            }
        }
    });
</script>
@endpush
