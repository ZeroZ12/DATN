@extends('admin.layouts.app')

@section('title', 'Chi tiết Tản nhiệt')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết Sự Kiện: {{ $suKien->ten_su_kien }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $suKien->id }}</li>
                <li><strong>Sản phẩm tham gia sự kiện:</strong>
                    @if($suKien->total > 0)
                        <span>{{ $suKien->total }} sản phẩm</span>
                    @else
                        <span class="text-muted">Chưa có sản phẩm</span>
                    @endif
                </li>
                <li><strong>Ngày bắt đầu:</strong> {{ $suKien->ngay_bat_dau->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày tạo:</strong> {{ $suKien->ngay_ket_thuc->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $suKien->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.sukien.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.sukien.edit', $suKien->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
