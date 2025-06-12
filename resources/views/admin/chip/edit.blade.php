@extends('admin.layouts.app')

@section('title', 'Sửa chip')

@section('content')
    <div class="container">
        <h2 class="mb-4">✏️ Sửa chip: <span class="text-primary">{{ $chip->ten }}</span></h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.chip.update', $chip->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="ten" class="form-label fw-semibold">Tên chip <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control"
                            value="{{ old('ten', $chip->ten) }}">
                        @error('ten')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $chip->mo_ta) }}</textarea>
                        @error('mo_ta')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.chip.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
