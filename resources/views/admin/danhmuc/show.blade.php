@extends('admin.layouts.app')

@section('title', 'Chi tiết danh mục')

@section('content')
    <h2>Chi tiết danh mục: {{ $danhmuc->ten }}</h2>



    <div class="mt-4">
        <h4>Thông tin chi tiết</h4>
        <ul>
            <li><strong>ID:</strong> {{ $danhmuc->id }}</li>
            <li><strong>Tên danh mục:</strong> {{ $danhmuc->ten }}</li>
            <li><strong>Ngày tạo:</strong> {{ $danhmuc->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Ngày cập nhật:</strong> {{ $danhmuc->updated_at->format('d/m/Y H:i') }}</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.danhmuc.edit', $danhmuc->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection
