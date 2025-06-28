@extends('admin.layouts.app')

@section('title', 'Quản lý banner')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📂 Danh sách banner</h2>
            <div>
                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary" title="Thêm mới"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a>
                <a href="{{ route('admin.banner.trashed') }}" class="btn btn-secondary me-2" title="Thùng rác"><i
                        class="fa fa-trash" aria-hidden="true"></i> Thùng rác</a>
                <a href="{{ route('admin.banner.index') }}" class="btn btn-primary" title="Banner hoạt động"><i
                        class="fa fa-image" aria-hidden="true"></i> Banner hoạt động</a>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên banner</th>
                            <th>Ảnh</th>
                            <th>Giảm giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td class="text-center">{{ $banner->id }}</td>
                                <td class="text-center">{{ $banner->title }}</td>
                                <td class="text-center image_banner">
                                    @if ($banner->image_url)
                                        <img class="w-100 h-100" src="{{ asset('storage/' . $banner->image_url) }}"
                                            alt="Ảnh lỗi">
                                    @else
                                        <span>Không có ảnh</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $banner->sale }}</td>

                                <td class="text-center">
                                    @if ($banner->deleted_at)
                                        <div class="hide badge badge-warning">
                                            Vô hiệu
                                        </div>
                                    @else
                                        <div class="show badge badge-success">
                                            Hoạt động
                                        </div>
                                    @endif
                                </td>
                                @if ($banner->deleted_at)
                                    <td class="text-center d-flex justify-content-center align-items-center gap-1" style="height: 100%;">
                                        <form action="{{ route('admin.banner.restore', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0 action-form"
                                              data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="restore" data-id="{{ $banner->id }}">
                                            @csrf
                                            <button onclick="return confirm('Bạn có chắc muốn khôi phục banner này?')" type="submit" class="btn btn-sm btn-success" title="Khôi phục"><i
                                                    class="fa fa-reply" aria-hidden="true"></i></button>
                                        </form>
                                        <form action="{{ route('admin.banner.forceDelete', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0 action-form">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Bạn chắc muốn xóa vĩnh viễn banner này?')" type="submit"  class="btn btn-sm btn-danger" title="Xóa vĩnh viễn"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                @else
                                    <td class="text-center d-flex justify-content-center align-items-center gap-1" style="height: 100%;">
                                        <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                           class="btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"
                                                                                       aria-hidden="true"></i></a>
                                        <a href="{{ route('admin.banner.show', $banner->id) }}"
                                           class="btn btn-sm btn-info" title="Chi tiết"><i class="fa fa-eye"
                                                                                          aria-hidden="true"></i></a>
                                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0 action-form"
                                              data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="soft-delete" data-id="{{ $banner->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Bạn chắc muốn xóa mềm banner này?')" type="submit" class="btn btn-sm btn-danger" title="Xóa mềm"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Chưa có banner nào.
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
@endsection

