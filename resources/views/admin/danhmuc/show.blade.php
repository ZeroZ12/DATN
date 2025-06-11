@extends('admin.layouts.app')

@section('title', 'Chi tiết danh mục')

@section('content')
    <div class="container">
        <h2 class="mb-4">📂 Chi tiết danh mục: <span class="text-primary">{{ $danhmuc->ten }}</span></h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3 fw-bold text-uppercase text-muted">Thông tin chi tiết</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $danhmuc->id }}</li>
                    <li class="list-group-item"><strong>Tên danh mục:</strong> {{ $danhmuc->ten }}</li>
                    <li class="list-group-item"><strong>Ngày tạo:</strong> {{ $danhmuc->created_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="list-group-item"><strong>Ngày cập nhật:</strong>
                        {{ $danhmuc->updated_at->format('d/m/Y H:i') }}</li>
                </ul>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
                    <a href="{{ route('admin.danhmuc.edit', $danhmuc->id) }}" class="btn btn-warning">✏️ Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection
