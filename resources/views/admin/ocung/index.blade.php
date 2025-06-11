@extends('admin.layouts.app')

@section('title', 'Quản lý ổ cứng')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách ổ cứng</h2>
            <a href="{{ route('admin.ocung.create') }}" class="btn btn-primary">+ Thêm ổ cứng</a>
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
                    <th>Loại</th>
                    <th>Dung lượng</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($oCungs as $oCung)
                    <tr>
                        <td>{{ $oCung->id }}</td>
                        <td>{{ $oCung->loai }}</td>
                        <td>{{ $oCung->dung_luong }}</td>
                        <td>{{ $oCung->mo_ta ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.ocung.edit', $oCung->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.ocung.destroy', $oCung->id) }}" method="POST"
                                class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Chưa có ổ cứng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
