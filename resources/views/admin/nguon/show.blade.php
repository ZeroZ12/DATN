@extends('admin.layouts.app')

@section('title', 'Chi tiết nguon')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết Nguồn: {{ $nguon->dung_luong }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $nguon->id }}</li>
                <li><strong>Nguồn:</strong> {{ $nguon->ten }}</li>
                <li><strong>Giá:</strong> {{ number_format($nguon->gia ?? '0') }} đ</li>
                <li><strong>Giá Sale:</strong> {{ number_format($nguon->gia_sale ?? '0') }} đ</li>
                <li><strong>Mô tả:</strong> {!! $nguon->mo_ta ?? 'N/A' !!}</li>
                <li><strong>Ngày tạo:</strong> {{ $nguon->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $nguon->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.nguon.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.nguon.edit', $nguon->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
