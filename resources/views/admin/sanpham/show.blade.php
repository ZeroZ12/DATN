@extends('admin.layouts.app')

@section('content')
    <h4>Chi tiết sản phẩm: {{ $sanpham->ten }}</h4>

    <div class="row">
        <div class="col-md-4">
            @if ($sanpham->anh_dai_dien)
                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" class="img-fluid rounded" alt="Ảnh đại diện">
            @else
                <p>Không có ảnh đại diện</p>
            @endif
        </div>
        <div class="col-md-8">
            <p><strong>Mã sản phẩm:</strong> {{ $sanpham->ma_san_pham }}</p>
            <p><strong>Mô tả:</strong> {{ $sanpham->mo_ta ?? 'Chưa có mô tả' }}</p>
            <p><strong>Chip:</strong> {{ $sanpham->chip->ten ?? 'Không có chip' }}</p>
            <p><strong>Mainboard:</strong> {{ $sanpham->mainboard->ten ?? 'Không có mainboard' }}</p>
            <p><strong>GPU:</strong> {{ $sanpham->gpu->ten ?? 'Không có GPU' }}</p>
            <p><strong>Danh mục:</strong> {{ $sanpham->danhMuc->ten ?? 'Không có danh mục' }}</p>
            <p><strong>Thương hiệu:</strong> {{ $sanpham->thuongHieu->ten ?? 'Không có thương hiệu' }}</p>
            <p><strong>Bảo hành:</strong> {{ $sanpham->bao_hanh_thang }} tháng</p>
            <p><strong>Hoạt động:</strong> {{ $sanpham->hoat_dong ? 'Có' : 'Không' }}</p>



            <div class="mt-3">
                <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning">Sửa</a>
                <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>

        </div>

    </div>
@endsection
