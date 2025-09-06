@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="container-fluid">
        <h1>Danh sách sản phẩm</h1>

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

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title fw-bold">Bộ lọc loại sản phẩm</div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sản phẩm mới</a>
                        <a href="{{ route('admin.sanpham.trash') }}" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Thùng rác</a>
                    </div>
                </div>
                <div class="mt-3">
                    <form class="search-form mb-0" action="{{ route('admin.search') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control pe-0" type="text" name="keyword" placeholder="Tìm kiếm ...">
                                <button class="btn btn-light btn-sm ms-2" type="submit">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                                </button>
                            </div>
                        </form>
                    </div>
                <form method="GET" class="mt-3">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary btn-toggle">
                            <input type="radio" name="filter_bienthe" value="" {{ request('filter_bienthe') === '' ? 'checked' : '' }} onchange="this.form.submit()">
                            <i class="fas fa-list"></i> Tất cả
                        </label>
                        <label class="btn btn-outline-primary btn-toggle">
                            <input type="radio" name="filter_bienthe" value="1" {{ request('filter_bienthe') === '1' ? 'checked' : '' }} onchange="this.form.submit()">
                            <i class="fas fa-boxes"></i> Có biến thể
                        </label>
                        <label class="btn btn-outline-primary btn-toggle">
                            <input type="radio" name="filter_bienthe" value="0" {{ request('filter_bienthe') === '0' ? 'checked' : '' }} onchange="this.form.submit()">
                            <i class="fas fa-box"></i> Không có biến thể
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <table class="table table-hover table-light align-middle">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Lượt xem</th>
                        <th>Lượt mua</th>
                        <th>Ảnh đại diện</th>
                        {{-- <th>Giá</th>
                        <th>Số lượng</th> --}}
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sanphams as $sanpham)
                        <tr>
                            <td>{{ $sanpham->id }}</td>
                            <td>{{ $sanpham->ten }}</td>
                            <td>{{ $sanpham->ma_san_pham }}</td>
                            <td>{{ $sanpham->danhMuc->ten ?? 'N/A' }}</td>
                            <td>{{ $sanpham->thuongHieu->ten ?? 'N/A' }}</td>
                            <td>{{ $sanpham->luot_xem ?? 'N/A' }}</td>
                            <td>{{ $sanpham->luot_mua ?? 'N/A' }}</td>
                            <td>
                                @if ($sanpham->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm"
                                        class="img-fluid rounded" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            {{-- <td>
                                @if (!$sanpham->co_bien_the)
                                    {{ number_format($sanpham->gia) }} đ
                                @else
                                    <span class="text-muted">Xem biến thể</span>
                                @endif
                            </td>
                            <td>
                                @if (!$sanpham->co_bien_the)
                                    {{ $sanpham->so_luong }}
                                @else
                                    <span class="text-muted">Xem biến thể</span>
                                @endif
                            </td> --}}
                            <td>
                                <div class="action-buttons d-flex gap-1 flex-wrap">
                                    <a href="{{ route('admin.sanpham.bienthe.index', $sanpham->id) }}"
                                        class="btn btn-secondary btn-sm" title="Biến thể">
                                        <i class="fas fa-boxes"></i>
                                    </a>
                                    <a href="{{ route('admin.sanpham.show', $sanpham->id) }}" class="btn btn-info btn-sm"
                                        title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning btn-sm"
                                        title="Sửa sản phẩm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sanpham.destroy', $sanpham->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa mềm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mềm sản phẩm này không?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Không có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center my-4">
                <nav aria-label="Product pagination">
                    {{ $sanphams->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }
        .btn-outline-danger {
            transition: all 0.2s ease-in-out;
        }
        .btn-outline-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }
        .btn-toggle {
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }
        .btn-toggle input:checked + .btn {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
        }
        .btn-toggle input:checked + .btn:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
        }
        .btn-toggle .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .pagination {
            --bs-pagination-padding-x: 1.1rem;
            --bs-pagination-padding-y: 0.6rem;
            --bs-pagination-font-size: 1.1rem;
            --bs-pagination-border-radius: 0.75rem;
            --bs-pagination-bg: #fff;
            --bs-pagination-border-color: #dee2e6;
            --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            --bs-pagination-active-bg: #dc3545;
            --bs-pagination-active-border-color: #dc3545;
            transition: all 0.3s ease-in-out;
        }
        .pagination .page-item {
            margin: 0 0.25rem;
        }
        .pagination .page-link {
            color: #dc3545;
            border: 1px solid #dc3545;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .pagination .page-link:hover {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }
        .pagination .page-link:focus {
            box-shadow: var(--bs-pagination-focus-box-shadow);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--bs-pagination-active-bg);
            border-color: var(--bs-pagination-active-border-color);
            color: #fff;
            box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            border-color: #dee2e6;
            background-color: #f8f9fa;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }
    </style>
@endpush
