@extends('admin.layouts.app')

@section('title', 'Quản lý RAM')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách RAM</h2>
            <a href="{{ route('admin.ram.create') }}" class="btn btn-primary">+ Thêm RAM</a>
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
                    <th>Dung lượng</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rams as $ram)
                    <tr>
                        <td>{{ $ram->id }}</td>
                        <td>{{ $ram->dung_luong }}</td>
                        <td>{{ $ram->mo_ta ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.ram.edit', $ram->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.ram.destroy', $ram->id) }}" method="POST" class="d-inline-block"
                                onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Chưa có RAM nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
