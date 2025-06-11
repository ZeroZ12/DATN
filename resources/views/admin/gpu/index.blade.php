@extends('admin.layouts.app')

@section('title', 'Quản lý GPU')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Danh sách GPU</h2>
        <div>
            <a href="{{ route('admin.gpu.trash') }}" class="btn btn-secondary">🗑 Thùng rác</a>
            <a href="{{ route('admin.gpu.create') }}" class="btn btn-primary">+ Thêm GPU</a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên GPU</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gpus as $gpu)
                <tr>
                    <td>{{ $gpu->id }}</td>
                    <td>{{ $gpu->ten }}</td>
                    <td>{{ $gpu->mo_ta ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.gpu.edit', $gpu->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.gpu.destroy', $gpu->id) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Chưa có GPU nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
