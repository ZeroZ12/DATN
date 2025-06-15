@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý Thương Hiệu</h1>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif {{-- MAKE SURE THIS @endif IS PRESENT AND CORRECT --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif {{-- MAKE SURE THIS @endif IS PRESENT AND CORRECT --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.thuonghieu.create') }}" class="btn btn-primary">Thêm Thương Hiệu Mới</a>
            <div class="btn-group">
                <a href="{{ route('admin.thuonghieu.index') }}"
                   class="btn btn-sm {{ !request()->has('status') || request()->status === 'active' ? 'btn-primary' : 'btn-outline-primary' }}">Đang Hoạt Động</a>
                <a href="{{ route('admin.thuonghieu.index', ['status' => 'deleted']) }}"
                   class="btn btn-sm {{ request()->status === 'deleted' ? 'btn-primary' : 'btn-outline-primary' }}">Đã Xóa Mềm</a>
                <a href="{{ route('admin.thuonghieu.index', ['status' => 'all']) }}"
                   class="btn btn-sm {{ request()->status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">Tất Cả</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Thương Hiệu</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Cập Nhật</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($thuongHieus as $thuongHieu) {{-- CHECK THIS @forelse --}}
                            <tr>
                                <td>{{ $thuongHieu->id }}</td>
                                <td>{{ $thuongHieu->ten }}</td>
                                <td>
                                    @if ($thuongHieu->deleted_at) {{-- CHECK THIS @if --}}
                                        <span class="badge badge-danger">Đã Xóa Mềm</span>
                                    @else
                                        <span class="badge badge-success">Đang Hoạt Động</span>
                                    @endif {{-- MAKE SURE THIS @endif IS PRESENT AND CORRECT --}}
                                </td>
                                <td>{{ $thuongHieu->created_at }}</td>
                                <td>{{ $thuongHieu->updated_at }}</td>
                                <td>
                                    @if ($thuongHieu->deleted_at) {{-- CHECK THIS @if --}}
                                        {{-- Nút Khôi phục --}}
                                        <form action="{{ route('admin.thuonghieu.restore', $thuongHieu->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc muốn khôi phục thương hiệu này không?')">Khôi phục</button>
                                        </form>
                                        {{-- Nút Xóa Vĩnh Viễn (tùy chọn) --}}
                                        <form action="{{ route('admin.thuonghieu.forceDelete', $thuongHieu->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn CÓ CHẮC muốn xóa vĩnh viễn thương hiệu này không? Hành động này không thể hoàn tác!')">Xóa Vĩnh Viễn</button>
                                        </form>
                                    @else {{-- CHECK THIS @else --}}
                                        {{-- Nút Sửa --}}
                                        <a href="{{ route('admin.thuonghieu.edit', $thuongHieu->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        {{-- Nút Xóa (Xóa mềm) --}}
                                        <form action="{{ route('admin.thuonghieu.destroy', $thuongHieu->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa mềm thương hiệu này không?')">Xóa</button>
                                        </form>
                                    @endif {{-- <--- THIS @endif IS THE MOST LIKELY CULPRIT IF LINE 102 IS THE END OF THIS BLOCK --}}
                                </td>
                            </tr>
                        @empty {{-- CHECK THIS @empty --}}
                            <tr>
                                <td colspan="6" class="text-center">Không có thương hiệu nào.</td>
                            </tr>
                        @endforelse {{-- MAKE SURE THIS @endforelse IS PRESENT AND CORRECT --}}
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $thuongHieus->links() }}
            </div>
        </div>
    </div>
</div>
@endsection {{-- MAKE SURE THIS @endsection IS PRESENT AND CORRECT --}}