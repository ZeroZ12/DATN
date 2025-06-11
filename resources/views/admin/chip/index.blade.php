@extends('admin.layouts.app')

@section('title', 'Quản lý chip')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary fw-bold">🧠 Danh sách chip</h2>
            <a href="{{ route('admin.chip.create') }}" class="btn btn-success">
                + Thêm chip mới
            </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Tên chip</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($chips as $chip)
                            <tr>
                                <td>{{ $chip->id }}</td>
                                <td class="fw-semibold">{{ $chip->ten }}</td>
                                <td>{{ $chip->mo_ta ?? '—' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.chip.edit', $chip->id) }}" class="btn btn-sm btn-warning me-1">
                                        ✏️ Sửa
                                    </a>
                                    <form action="{{ route('admin.chip.destroy', $chip->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa chip này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có chip nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
