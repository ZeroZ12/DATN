@extends('admin.layouts.app')

@section('title', 'Thêm banner')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thêm danh mục mới</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Tên Banner<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_url" class="form-label">Ảnh Banner <span class="text-danger">*</span></label>
                        <input type="file" name="image_url" id="image_url" class="form-control" required
                            value="{{ old('image_url') }}">
                        @error('image_url')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sale" class="form-label">Giảm giá theo sự kiện<span
                                class="text-danger">*</span></label>
                        <input type="text" name="sale" id="sale" class="form-control" required
                            value="{{ old('sale') }}">
                        @error('sale')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả<span
                                class="text-danger">*</span></label>
                        <input type="text" name="description" id="description" class="form-control" required
                            value="{{ old('description') }}">
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary" title="Quay lại"><i class="fa fa-reply" aria-hidden="true"></i></a>
                        <button type="submit" class="btn btn-success" title="Lưu"><i class="fa fa-save" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
