@extends('admin.layouts.app')

@section('title', 'Quản lý chip')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Danh sách chip</h2>
        <a href="{{ route('admin.chip.create') }}" class="btn btn-primary">+ Thêm chip</a>
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
                <th>Tên chip</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($chips as $chip)
                <tr>
                    <td>{{ $chip->id }}</td>
                    <td>{{ $chip->ten }}</td>
                    <td>{{ $chip->mo_ta ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.chip.edit', $chip->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.chip.destroy', $chip->id) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Chưa có chip nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection