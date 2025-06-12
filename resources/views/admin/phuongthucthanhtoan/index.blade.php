@extends('admin.layouts.app')

@section('title', 'Quản lý phương thức thanh toán')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách phương thức thanh toán</h2>
            <a href="{{ route('admin.phuongthucthanhtoan.create') }}" class="btn btn-primary">+ Thêm phương thức thanh
                toán</a>
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
                    <th>Tên phương thức</th>
                    <th>Mô tả</th>
                    <th>Hoạt động</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($phuongThucThanhToans as $phuongThucThanhToan)
                    <tr>
                        <td>{{ $phuongThucThanhToan->id }}</td>
                        <td>{{ $phuongThucThanhToan->ten }}</td>
                        <td>{{ $phuongThucThanhToan->mo_ta ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $phuongThucThanhToan->hoat_dong ? 'bg-success' : 'bg-secondary' }}">
                                {{ $phuongThucThanhToan->hoat_dong ? 'Có' : 'Không' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.phuongthucthanhtoan.edit', $phuongThucThanhToan->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.phuongthucthanhtoan.destroy', $phuongThucThanhToan->id) }}"
                                method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Chưa có phương thức thanh toán nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
