@extends('admin.layouts.app')

@section('title', 'Quản lý mainboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Danh sách mainboard</h2>
        <div>
            <a href="{{ route('admin.mainboard.trash') }}" class="btn btn-secondary">🗑 Xem thùng rác</a>
            <a href="{{ route('admin.mainboard.create') }}" class="btn btn-primary">+ Thêm mainboard</a>
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
                <th>Tên mainboard</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mainboards as $mainboard)
                <tr>
                    <td>{{ $mainboard->id }}</td>
                    <td>{{ $mainboard->ten }}</td>
                    <td>{{ $mainboard->mo_ta ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.mainboard.edit', $mainboard->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.mainboard.destroy', $mainboard->id) }}" method="POST"
                            class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Chưa có mainboard nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
