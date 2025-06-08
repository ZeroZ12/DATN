@extends('admin.layouts.app')

@section('title', 'Chi tiết ổ cứng')

@section('content')
    <h2>Chi tiết ổ cứng: {{ $oCung->dung_luong }} ({{ $oCung->loai }})</h2>

    <div class="mt-4">
        <h4>Thông tin chi tiết</h4>
        <ul>
            <li><strong>ID:</strong> {{ $oCung->id }}</li>
            <li><strong>Loại:</strong> {{ $oCung->loai }}</li>
            <li><strong>Dung lượng:</strong> {{ $oCung->dung_luong }}</li>
            <li><strong>Mô tả:</strong> {{ $oCung->mo_ta ?? 'N/A' }}</li>
            <li><strong>Ngày tạo:</strong> {{ $oCung->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Ngày cập nhật:</strong> {{ $oCung->updated_at->format('d/m/Y H:i') }}</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.ocung.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.ocung.edit', $oCung->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection