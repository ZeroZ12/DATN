@extends('admin.layouts.app')

@section('title', 'Tất cả banner')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0">📂 Tất cả banner</h2>
            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">
                <i class="fa fa-plus-square me-1"></i> Thêm mới
            </a>
        </div>
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th style="min-width: 180px;">Tên banner</th>
                            <th style="width: 120px;">Ảnh</th>
                            <th style="width: 100px;">Trạng thái</th>
                            <th style="width: 160px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td class="text-center">{{ $banner->id }}</td>
                                <td class="text-center">{{ $banner->title }}</td>
                                <td class="text-center">
                                    @if ($banner->image_url)
                                        <img class="banner-img" src="{{ asset('storage/' . $banner->image_url) }}"
                                            alt="Ảnh lỗi">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($banner->deleted_at)
                                        <span class="badge bg-warning text-dark">Vô hiệu</span>
                                    @else
                                        <span class="badge bg-success">Hoạt động</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.banner.show', $banner->id) }}" class="btn btn-sm btn-info"
                                            title="Chi tiết">
                                            Xem
                                        </a>
                                        @if ($banner->deleted_at)
                                            <form action="{{ route('admin.banner.restore', $banner->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                <button onclick="return confirm('Khôi phục banner này?')" type="submit"
                                                    class="btn btn-sm btn-success" title="Khôi phục">
                                                    Khôi phục
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.banner.forceDelete', $banner->id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Xóa vĩnh viễn banner này?')" type="submit"
                                                    class="btn btn-sm btn-danger" title="Xóa vĩnh viễn">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                                class="btn btn-sm btn-warning" title="Sửa">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn chắc muốn xóa mềm banner này?')"
                                                    type="submit" class="btn btn-sm btn-danger" title="Xóa mềm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Chưa có banner nào.
                                    <a href="{{ route('admin.banner.trashed') }}">Xem các banner đã xóa mềm?</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center my-4">
                <nav aria-label="Page navigation example">
                    {{ $banners->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
    <style>
        .banner-img {
            width: 80px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
            background: #fafafa;
        }

        .table td,
        .table th {
            vertical-align: middle !important;
        }

        .btn-info {
            color: #fff;
        }
    </style>
@endsection
