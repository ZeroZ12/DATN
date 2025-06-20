@extends('admin.layouts.app')

@section('title', 'Chi tiết mainboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết mainboard: {{ $mainboard->ten }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $mainboard->id }}</li>
                <li><strong>Tên mainboard:</strong> {{ $mainboard->ten }}</li>
                <li><strong>Mô tả:</strong> {!! $mainboard->mo_ta ?? 'N/A' !!}</li>
                <li><strong>Ngày tạo:</strong> {{ $mainboard->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $mainboard->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.mainboard.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.mainboard.edit', $mainboard->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
