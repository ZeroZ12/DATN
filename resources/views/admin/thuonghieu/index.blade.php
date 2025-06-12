@extends('admin.layouts.app')

@section('title', 'Quản lý thương hiệu')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách thương hiệu</h2>
            <a href="{{ route('admin.thuonghieu.create') }}" class="btn btn-primary">+ Thêm thương hiệu</a>
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
                    <th>Tên thương hiệu</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($thuongHieus as $thuongHieu)
                    <tr>
                        <td>{{ $thuongHieu->id }}</td>
                        <td>{{ $thuongHieu->ten }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.thuonghieu.edit', $thuongHieu->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.thuonghieu.destroy', $thuongHieu->id) }}" method="POST"
                                class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Chưa có thương hiệu nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
