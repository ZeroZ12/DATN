@extends('admin.layouts.app')

@section('title', 'Chi tiết banner')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fa fa-image me-2"></i> Chi tiết Banner
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if ($banner->image_url)
                                <img src="{{ asset('storage/' . $banner->image_url) }}" class="banner-img-lg mb-2"
                                    alt="Banner">
                            @else
                                <div class="text-muted">Không có ảnh</div>
                            @endif
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 150px;">ID:</th>
                                <td>{{ $banner->id }}</td>
                            </tr>
                            <tr>
                                <th>Tên banner:</th>
                                <td>{{ $banner->title }}</td>
                            </tr>
                            <tr>
                                <th>Giảm giá:</th>
                                <td>{{ $banner->sale }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái:</th>
                                <td>
                                    @if ($banner->deleted_at)
                                        <span class="badge bg-warning text-dark">Vô hiệu</span>
                                    @else
                                        <span class="badge bg-success">Hoạt động</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Ngày tạo:</th>
                                <td>{{ $banner->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Cập nhật:</th>
                                <td>{{ $banner->updated_at }}</td>
                            </tr>
                        </table>
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
                                    <a class="dropdown-item" href="{{ route('admin.banner.edit', $banner->id) }}">Sửa</a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
