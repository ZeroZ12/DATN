@extends('admin.layouts.app')

@section('title', 'Chi tiết Tản nhiệt')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết Tản Nhiệt: {{ $TanNhiet->ten }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $TanNhiet->id }}</li>
                <li><strong>Dung lượng:</strong> {{ $TanNhiet->ten }}</li>
                <li><strong>Giá:</strong> {{ number_format($TanNhiet->gia ?? '0') }} đ</li>
                <li><strong>Giá Sale:</strong> {{ number_format($TanNhiet->gia_sale ?? '0') }} đ</li>
                <li><strong>Mô tả:</strong> {!! $TanNhiet->mo_ta ?? 'N/A' !!}</li>
                <li><strong>Ngày tạo:</strong> {{ $TanNhiet->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $TanNhiet->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.tannhiet.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.tannhiet.edit', $TanNhiet->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
