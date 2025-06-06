@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Danh sách danh mục</h2>
        <a href="{{ route('admin.danhmuc.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
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
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($danhmucs as $dm)
                <tr>
                    <td>{{ $dm->id }}</td>
                    <td>{{ $dm->ten }}</td>
                    <td>
                        <a href="{{ route('admin.danhmuc.edit', $dm->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.danhmuc.destroy', $dm->id) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Chưa có danh mục nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
