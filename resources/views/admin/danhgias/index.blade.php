
@extends('admin.layouts.app')

@section('title', 'Quản lý Đánh giá sản phẩm')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý Đánh giá sản phẩm</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bộ lọc đánh giá</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.danhgias.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select name="trang_thai" id="trang_thai" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                @foreach($trangThaiOptions as $value => $label)
                                    <option value="{{ $value }}" {{ request('trang_thai') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="so_sao" class="form-label">Số sao</label>
                            <select name="so_sao" id="so_sao" class="form-select">
                                <option value="">Tất cả số sao</option>
                                @foreach($soSaoOptions as $value => $label)
                                    <option value="{{ $value }}" {{ request('so_sao') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="san_pham" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="san_pham" id="san_pham" class="form-control"
                                   value="{{ request('san_pham') }}" placeholder="Nhập tên sản phẩm...">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="nguoi_dung" class="form-label">Người đánh giá</label>
                            <input type="text" name="nguoi_dung" id="nguoi_dung" class="form-control"
                                   value="{{ request('nguoi_dung') }}" placeholder="Tên hoặc email...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="tu_ngay" class="form-label">Từ ngày</label>
                            <input type="date" name="tu_ngay" id="tu_ngay" class="form-control"
                                   value="{{ request('tu_ngay') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="den_ngay" class="form-label">Đến ngày</label>
                            <input type="date" name="den_ngay" id="den_ngay" class="form-control"
                                   value="{{ request('den_ngay') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="binh_luan" class="form-label">Nội dung đánh giá</label>
                            <input type="text" name="binh_luan" id="binh_luan" class="form-control"
                                   value="{{ request('binh_luan') }}" placeholder="Tìm trong đánh giá...">
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <div class="btn-group w-100" role="group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Lọc
                                </button>
                                <a href="{{ route('admin.danhgias.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Summary -->
        @if(request()->hasAny(['trang_thai', 'so_sao', 'san_pham', 'nguoi_dung', 'tu_ngay', 'den_ngay', 'binh_luan']))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>Kết quả lọc:</strong> Tìm thấy {{ $danhGias->total() }} đánh giá phù hợp với tiêu chí lọc.
            <a href="{{ route('admin.danhgias.index') }}" class="btn btn-sm btn-outline-primary ms-2">Xem tất cả</a>
        </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách Đánh giá</h6>
                <span class="badge bg-primary">{{ $danhGias->total() }} đánh giá</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Người đánh giá</th>
                                <th>Số sao</th>
                                <th>Đánh giá</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($danhGias as $danhGia)
                                <tr>
                                    <td>{{ $danhGia->id }}</td>
                                    <td>
                                        <a href="{{ route('sanpham.show', $danhGia->sanPham->id) }}" target="_blank">
                                            {{ $danhGia->sanPham->ten ?? 'Sản phẩm không tồn tại' }}
                                        </a>
                                    </td>
                                    <td>{{ $danhGia->user->ho_ten ?? 'Người dùng không tồn tại' }}</td>
                                    <td>
                                        @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                            <i class="far fa-star text-warning"></i>
                                        @endfor
                                        ({{ $danhGia->so_sao }})
                                    </td>
                                    <td>{{ Str::limit($danhGia->binh_luan, 50, '...') }}</td>
                                    <td>
                                        @if ($danhGia->trang_thai == 'cho_duyet')
                                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                        @elseif ($danhGia->trang_thai == 'da_duyet')
                                            <span class="badge bg-success">Đã duyệt</span>
                                        @else
                                            <span class="badge bg-danger">Từ chối</span>
                                        @endif
                                    </td>
                                    <td>{{ $danhGia->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.danhgias.show', $danhGia->id) }}" class="btn btn-info btn-sm mb-1" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>


                                        @if ($danhGia->trang_thai == 'cho_duyet' || $danhGia->trang_thai == 'tu_choi')
                                            <form action="{{ route('admin.danhgias.approve', $danhGia->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm mb-1" title="Duyệt">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($danhGia->trang_thai == 'cho_duyet' || $danhGia->trang_thai == 'da_duyet')
                                            <form action="{{ route('admin.danhgias.reject', $danhGia->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm mb-1" title="Từ chối">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có đánh giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $danhGias->links('pagination::bootstrap-5') }} {{-- Sử dụng phân trang Bootstrap 5 --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .filter-card {
        border-left: 4px solid #007bff;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .btn-group .btn {
        border-radius: 0;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .badge {
        font-size: 0.75em;
    }
    .alert-info {
        border-left: 4px solid #17a2b8;
    }
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when select dropdowns change
    const selectElements = document.querySelectorAll('select[name="trang_thai"], select[name="so_sao"]');
    selectElements.forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });

    // Date range validation
    const tuNgayInput = document.getElementById('tu_ngay');
    const denNgayInput = document.getElementById('den_ngay');

    tuNgayInput.addEventListener('change', function() {
        if (this.value && denNgayInput.value && this.value > denNgayInput.value) {
            alert('Ngày bắt đầu không thể lớn hơn ngày kết thúc!');
            this.value = '';
        }
    });

    denNgayInput.addEventListener('change', function() {
        if (this.value && tuNgayInput.value && this.value < tuNgayInput.value) {
            alert('Ngày kết thúc không thể nhỏ hơn ngày bắt đầu!');
            this.value = '';
        }
    });

    // Clear all filters
    document.querySelector('a[href="{{ route("admin.danhgias.index") }}"]').addEventListener('click', function(e) {
        if (confirm('Bạn có chắc muốn xóa tất cả bộ lọc?')) {
            // Let the default link behavior proceed
        } else {
            e.preventDefault();
        }
    });

    // Show loading state on form submit
    document.getElementById('filterForm').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lọc...';
        submitBtn.disabled = true;
    });
});
</script>
@endpush
