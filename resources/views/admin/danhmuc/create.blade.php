@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thêm danh mục mới</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.danhmuc.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control" required
                            value="{{ old('ten') }}">
                        @error('ten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                        <input type="file" name="hinh_anh" id="hinh_anh" class="form-control" value="{{ old('hinh_anh') }}"
                            accept="image/*">
                          
                        @error('hinh_anh')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-success">💾 Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


