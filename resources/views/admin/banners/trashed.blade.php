@extends('admin.layouts.app')

@section('title', 'Banner đã xóa mềm')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0">🗑️ Banner đã xóa mềm</h2>
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left me-1"></i> Quay lại danh sách
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
                            <th style="width: 180px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($banners) }} --}}
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
                                    <span class="badge bg-warning text-dark">Vô hiệu</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Hành động
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('admin.banner.restore', $banner->id) }}"
                                                    method="POST" onsubmit="return confirm('Khôi phục banner này?')">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Khôi phục</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.banner.forceDelete', $banner->id) }}"
                                                    method="POST" onsubmit="return confirm('Xóa vĩnh viễn banner này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Xóa vĩnh
                                                        viễn</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Không có banner nào trong thùng rác.
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
    </style>
@endsection
