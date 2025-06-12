@extends('admin.layouts.app')

@section('title', 'Sửa GPU')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa GPU: {{ $gpu->ten }}</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.gpu.update', $gpu->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên GPU <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control"
                            value="{{ old('ten', $gpu->ten) }}">
                        @error('ten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô tả</label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $gpu->mo_ta) }}</textarea>
                        @error('mo_ta')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.gpu.index') }}" class="btn btn-secondary">← Hủy</a>
                        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
