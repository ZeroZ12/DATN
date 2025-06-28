@extends('admin.layouts.app')

@section('title', 'Chi tiết banner')

@section('content')
<style>
    .img-banner
    {
        width: 240px;
        height: 120px;
    }
</style>
    <div class="container">
        <h2 class="mb-4">📂 Chi tiết banner: <span class="text-primary">{{ $banner->title }}</span></h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3 fw-bold text-uppercase text-muted">Thông tin chi tiết</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $banner->id }}</li>
                    <li class="list-group-item"><strong>Tên banner:</strong> {{ $banner->title }}</li>
                    <li class="list-group-item"><strong>Giảm giá:</strong> {{ $banner->sale }} (%)</li>
                    <li class="list-group-item"><strong>Ngày tạo:</strong> {{ $banner->created_at->format('d/m/Y H:i:s') }}
                    </li>
                    <li class="list-group-item"><strong>Ngày cập nhật:</strong>
                        {{ $banner->updated_at->format('d/m/Y H:i:s') }}</li>
                    <li class="list-group-item"><strong>Mô tả:</strong> {{ $banner->description }}</li>
                    <li class="list-group-item img-banner mb-3">
                    <strong>Ảnh:</strong>
                    @if ($banner->image_url)
                        <img class="w-100 h-100" src="{{ asset('storage/' . $banner->image_url) }}" alt="{{ $banner->title }}">
                    @else
                        <span>Không có ảnh</span>
                    @endif
                    </li>
                    <li class="list-group-item"><strong>Trạng thái:</strong>
                    @if ($banner->deleted_at)
                        <span>Vô hiệu</span>
                    @else
                        <span>Hoạt động</span> 
                    @endif
                    </li>

                </ul>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary" title="Quay lại"><i class="fa fa-reply" aria-hidden="true"></i></a>
                    <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-warning" title="Chỉnh sửa"><i class="fa fa-edit" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
