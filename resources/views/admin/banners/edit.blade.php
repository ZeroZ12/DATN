@extends('admin.layouts.app')

@section('title', 'Thêm banner')

@section('content')
<style>
    .image_banner
    {
        width: 240px;
        height: 120px;
    }
</style>
    <div class="container">
        <h2 class="mb-4">Cập nhật Banner</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên Banner<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required
                            value="{{ old('title', $banner->title) }}">
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
                    
                    <div class="mb-3 image_banner">
                        <img class="w-100 h-100" src="{{ asset('storage/' . $banner->image_url) }}" alt="{{ $banner->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="sale" class="form-label">Giảm giá theo sự kiện (%)<span
                                class="text-danger">*</span></label>
                        <input type="text" name="sale" id="sale" class="form-control" required
                            value="{{ old('sale', $banner->sale) }}">
                        @error('sale')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả<span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" required rows="4">{{ old('description', $banner->description) }}</textarea>

                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary" title="Quay lại"><i
                                class="fa fa-reply" aria-hidden="true"></i></a>
                        <button type="submit" class="btn btn-success" title="Lưu"><i class="fa fa-save"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
