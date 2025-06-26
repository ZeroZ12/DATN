@extends('admin.layouts.app')

@section('title', 'Chi tiết RAM')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết RAM: {{ $ram->dung_luong }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $ram->id }}</li>
                <li><strong>Dung lượng:</strong> {{ $ram->dung_luong }}</li>
                <li><strong>Mô tả:</strong> {!! $ram->mo_ta ?? 'N/A' !!}</li>
                <li><strong>Ngày tạo:</strong> {{ $ram->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $ram->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.ram.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.ram.edit', $ram->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
