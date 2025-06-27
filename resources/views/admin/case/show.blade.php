@extends('admin.layouts.app')

@section('title', 'Chi tiết Case')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết Case: {{ $cases->ten }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $cases->id }}</li>
                <li><strong>Case :</strong> {{ $cases->ten }}</li>
                <li><strong>Mô tả:</strong> {!! $cases->mo_ta ?? 'N/A' !!}</li>
                <li><strong>Ngày tạo:</strong> {{ $cases->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $cases->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.case.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.case.edit', $cases->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection
