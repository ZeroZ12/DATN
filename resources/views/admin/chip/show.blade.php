@extends('admin.layouts.app')

@section('title', 'Chi tiết chip')

@section('content')
    <h2>Chi tiết chip: {{ $chip->ten }}</h2>

    <div class="mt-4">
        <h4>Thông tin chi tiết</h4>
        <ul>
            <li><strong>ID:</strong> {{ $chip->id }}</li>
            <li><strong>Tên chip:</strong> {{ $chip->ten }}</li>
            <li><strong>Mô tả:</strong> {{ $chip->mo_ta ?? 'N/A' }}</li>
            <li><strong>Ngày tạo:</strong> {{ $chip->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Ngày cập nhật:</strong> {{ $chip->updated_at->format('d/m/Y H:i') }}</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.chip.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.chip.edit', $chip->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection