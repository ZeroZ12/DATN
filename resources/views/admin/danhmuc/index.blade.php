@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📂 Danh sách danh mục</h2>
            <div>
                <a href="{{ route('admin.danhmuc.trashed') }}" class="btn btn-secondary me-2">🗑️ Thùng rác danh mục</a>
                <a href="{{ route('admin.danhmuc.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
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
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ddanhmucs as $dm)
                            <tr>
                                <td class="text-center">{{ $dm->id }}</td>
                                <td class="text-center">{{ $dm->ten }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.danhmuc.edit', $dm->id) }}"
                                        class="btn btn-sm btn-warning me-1">✏️ Sửa</a>
                                    <a href="{{ route('admin.danhmuc.show', $dm->id) }}"
                                        class="btn btn-sm btn-info me-1">👁️ Xem</a>
                                    <form action="{{ route('admin.danhmuc.destroy', $dm->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa mềm danh mục này? Các sản phẩm thuộc danh mục này cũng sẽ bị xóa mềm.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️ Xóa mềm</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Chưa có danh mục nào.
                                    <a href="{{ route('admin.danhmuc.trashed') }}">Xem các danh mục đã xóa mềm?</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $ddanhmucs->links() }}
            </div>

        </div>
    </div>
@endsection
