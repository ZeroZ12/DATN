@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📂 Danh sách danh mục</h2>
            <a href="{{ route('admin.danhmuc.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Tên danh mục</th>
                            <th style="width: 160px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($danhmucs as $dm)
                            <tr>
                                <td class="text-center">{{ $dm->id }}</td>
                                <td>{{ $dm->ten }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.danhmuc.edit', $dm->id) }}"
                                        class="btn btn-sm btn-warning me-1">✏️ Sửa</a>
                                    <form action="{{ route('admin.danhmuc.destroy', $dm->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
