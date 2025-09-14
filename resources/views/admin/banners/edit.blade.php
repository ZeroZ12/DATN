@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa banner')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning fw-bold">
                        <i class="fa fa-edit me-2"></i> Chỉnh sửa Banner
                    </div>
                    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                @if ($banner->image_url)
                                    <img src="{{ asset('storage/' . $banner->image_url) }}" class="banner-img-lg mb-2"
                                        alt="Banner">
                                @else
                                    <div class="text-muted">Không có ảnh</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Tên banner</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $banner->title) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Ảnh banner (chọn để thay đổi)</label>
                                <input class="form-control" type="file" id="image_url" name="image_url" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <input type="text" class="form-control"
                                    value="{{ $banner->deleted_at ? 'Vô hiệu' : 'Hoạt động' }}" disabled>
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
                                        <button type="submit" class="dropdown-item">Lưu thay đổi</button>
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
