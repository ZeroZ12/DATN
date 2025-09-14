@extends('admin.layouts.app')

@section('title', 'Thêm banner mới')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fa fa-plus-square me-2"></i> Thêm Banner Mới
                    </div>
                    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <img src="https://via.placeholder.com/320x160?text=Preview" class="banner-img-lg mb-2"
                                    id="preview-img" alt="Preview">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Tên banner</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Ảnh banner</label>
                                <input class="form-control" type="file" id="image_url" name="image_url" accept="image/*"
                                    onchange="previewBanner(event)">
                                @error('image_url')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    Hành động
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.banner.index') }}">Quay lại</a>
                                    </li>
                                    <li>
                                        <button type="submit" class="dropdown-item">Thêm mới</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .banner-img-lg {
            width: 320px;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #eee;
            background: #fafafa;
        }
    </style>
    
@endsection
@section('js-custom')
<script>
        function previewBanner(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection
