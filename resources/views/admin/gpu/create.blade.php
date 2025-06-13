@extends('admin.layouts.app')

@section('title', 'Thêm GPU')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thêm GPU mới</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.gpu.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên GPU <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control"
                            value="{{ old('ten') }}">
                        @error('ten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô tả</label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta') }}</textarea>
                        @error('mo_ta')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.gpu.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-success">💾 Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
