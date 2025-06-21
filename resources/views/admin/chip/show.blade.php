@extends('admin.layouts.app')

@section('title', 'Chi tiết chip')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-primary fw-bold">🔍 Chi tiết chip: {{ $chip->ten }}</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>ID:</strong> {{ $chip->id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Tên chip:</strong> {{ $chip->ten }}
                    </li>
                    <li class="list-group-item">
                        <strong>Mô tả:</strong> {!! $chip->mo_ta ?? '—' !!}
                    </li>
                    <li class="list-group-item">
                        <strong>Ngày tạo:</strong> {{ $chip->created_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Ngày cập nhật:</strong> {{ $chip->updated_at->format('d/m/Y H:i') }}
                    </li>
                </ul>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.chip.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
                    <a href="{{ route('admin.chip.edit', $chip->id) }}" class="btn btn-warning">✏️ Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection
