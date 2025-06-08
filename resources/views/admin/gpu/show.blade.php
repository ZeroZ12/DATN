@extends('admin.layouts.app')

@section('title', 'Chi tiết GPU')

@section('content')
    <h2>Chi tiết GPU: {{ $gpu->ten }}</h2>

    <div class="mt-4">
        <h4>Thông tin chi tiết</h4>
        <ul>
            <li><strong>ID:</strong> {{ $gpu->id }}</li>
            <li><strong>Tên GPU:</strong> {{ $gpu->ten }}</li>
            <li><strong>Mô tả:</strong> {{ $gpu->mo_ta ?? 'N/A' }}</li>
            <li><strong>Ngày tạo:</strong> {{ $gpu->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Ngày cập nhật:</strong> {{ $gpu->updated_at->format('d/m/Y H:i') }}</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.gpu.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.gpu.edit', $gpu->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection