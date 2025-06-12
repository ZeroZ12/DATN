@extends('admin.layouts.app')

@section('title', 'Chi tiết thương hiệu')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết thương hiệu: {{ $thuongHieu->ten }}</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3 text-primary">Thông tin chi tiết</h5>
                <ul class="list-unstyled mb-4">
                    <li><strong>ID:</strong> {{ $thuongHieu->id }}</li>
                    <li><strong>Tên thương hiệu:</strong> {{ $thuongHieu->ten }}</li>
                    <li><strong>Ngày tạo:</strong> {{ $thuongHieu->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Ngày cập nhật:</strong> {{ $thuongHieu->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
                    <a href="{{ route('admin.thuonghieu.edit', $thuongHieu->id) }}" class="btn btn-warning">✏️ Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection
