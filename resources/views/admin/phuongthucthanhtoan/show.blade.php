@extends('admin.layouts.app')

@section('title', 'Chi tiết phương thức thanh toán')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết phương thức thanh toán: {{ $phuongThucThanhToan->ten }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled mb-0">
                <li><strong>ID:</strong> {{ $phuongThucThanhToan->id }}</li>
                <li><strong>Tên phương thức:</strong> {{ $phuongThucThanhToan->ten }}</li>
                <li><strong>Mô tả:</strong> {{ $phuongThucThanhToan->mo_ta ?? 'N/A' }}</li>
                <li>
                    <strong>Hoạt động:</strong>
                    <span class="badge {{ $phuongThucThanhToan->hoat_dong ? 'bg-success' : 'bg-secondary' }}">
                        {{ $phuongThucThanhToan->hoat_dong ? 'Có' : 'Không' }}
                    </span>
                </li>
                <li><strong>Ngày tạo:</strong> {{ $phuongThucThanhToan->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $phuongThucThanhToan->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.phuongthucthanhtoan.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.phuongthucthanhtoan.edit', $phuongThucThanhToan->id) }}" class="btn btn-warning">Chỉnh
                sửa</a>
        </div>
    </div>
@endsection
