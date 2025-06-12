@extends('admin.layouts.app')

@section('title', 'Quản lý mainboard')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 text-primary fw-bold">🧩 Danh sách Mainboard</h2>
            <a href="{{ route('admin.mainboard.create') }}" class="btn btn-success">
                + Thêm mainboard mới
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
                            <th scope="col">🖥️ Tên mainboard</th>
                            <th scope="col">📄 Mô tả</th>
                            <th scope="col" class="text-center">⚙️ Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mainboards as $mainboard)
                            <tr>
                                <td>{{ $mainboard->id }}</td>
                                <td class="fw-semibold">{{ $mainboard->ten }}</td>
                                <td>{{ $mainboard->mo_ta ?? '—' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.mainboard.edit', $mainboard->id) }}"
                                        class="btn btn-sm btn-warning me-1">
                                        ✏️ Sửa
                                    </a>
                                    <a href="{{ route('admin.mainboard.show', $mainboard->id) }}"
                                        class="btn btn-sm btn-info me-1">
                                        👁️ Xem
                                    </a>
                                    <form action="{{ route('admin.mainboard.destroy', $mainboard->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa mainboard này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có mainboard nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
