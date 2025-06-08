@extends('admin.layouts.app')

@section('title', 'Chi tiết thương hiệu')

@section('content')
    <h2>Chi tiết thương hiệu: {{ $thuongHieu->ten }}</h2>

    <div class="mt-4">
        <h4>Thông tin chi tiết</h4>
        <ul>
            <li><strong>ID:</strong> {{ $thuongHieu->id }}</li>
            <li><strong>Tên thương hiệu:</strong> {{ $thuongHieu->ten }}</li>
            <li><strong>Ngày tạo:</strong> {{ $thuongHieu->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Ngày cập nhật:</strong> {{ $thuongHieu->updated_at->format('d/m/Y H:i') }}</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.thuonghieu.edit', $thuongHieu->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection