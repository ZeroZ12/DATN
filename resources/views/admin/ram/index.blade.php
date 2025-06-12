@extends('admin.layouts.app')

@section('title', 'Quản lý RAM')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary fw-bold">📦 Danh sách RAM</h2>
            <div>
                <a href="{{ route('admin.ram.trash') }}" class="btn btn-outline-secondary me-2">🗑️ Thùng rác</a>
                <a href="{{ route('admin.ram.create') }}" class="btn btn-success">+ Thêm RAM mới</a>
            </div>
        </div>

        <!-- Thông báo thành công -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <!-- Bảng RAM -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Dung lượng</th>
                            <th>Mô tả</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rams as $ram)
                            <tr>
                                <td>{{ $ram->id }}</td>
                                <td class="fw-semibold">{{ $ram->dung_luong }}</td>
                                <td>{{ $ram->mo_ta ?? '—' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.ram.edit', $ram->id) }}" class="btn btn-sm btn-warning me-1">
                                        ✏️ Sửa
                                    </a>
                                    <form action="{{ route('admin.ram.destroy', $ram->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa RAM này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có RAM nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
