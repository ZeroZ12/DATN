@extends('admin.layouts.app')

@section('title', 'Chi tiết GPU')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết GPU: {{ $gpu->ten }}</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3">Thông tin chi tiết</h5>
                <ul class="list-unstyled mb-4">
                    <li><strong>ID:</strong> {{ $gpu->id }}</li>
                    <li><strong>Tên GPU:</strong> {{ $gpu->ten }}</li>
                    <li><strong>Mô tả:</strong> {!! $gpu->mo_ta ?? 'N/A' !!}</li>
                    <li><strong>Ngày tạo:</strong> {{ $gpu->created_at->format('d/m/Y H:i') }}</li>
                    <li><strong>Ngày cập nhật:</strong> {{ $gpu->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.gpu.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
                    <a href="{{ route('admin.gpu.edit', $gpu->id) }}" class="btn btn-warning">✏️ Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection
