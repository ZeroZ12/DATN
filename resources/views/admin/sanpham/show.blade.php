@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Chi tiết sản phẩm: {{ $sanpham->ten }}</h1>

        <div class="mb-3">
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Trở lại danh sách</a>
            <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning">Sửa</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Tên sản phẩm</th>
                <td>{{ $sanpham->ten }}</td>
            </tr>
            <tr>
                <th>Mã sản phẩm</th>
                <td>{{ $sanpham->ma_san_pham }}</td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>{{ $sanpham->mo_ta }}</td>
            </tr>
            <tr>
                <th>Danh mục</th>
                <td>{{ $sanpham->danhMuc->ten ?? 'Không có danh mục' }}</td>
            </tr>
            <tr>
                <th>Thương hiệu</th>
                <td>{{ $sanpham->thuongHieu->ten ?? 'Không có thương hiệu' }}</td>
            </tr>
            <tr>
                <th>Chip</th>
                <td>{{ $sanpham->chip->ten ?? 'Không có chip' }}</td>
            </tr>
            <tr>
                <th>Mainboard</th>
                <td>{{ $sanpham->mainboard->ten ?? 'Không có mainboard' }}</td>
            </tr>
            <tr>
                <th>GPU</th>
                <td>{{ $sanpham->gpu->ten ?? 'Không có GPU' }}</td>
            </tr>
            <tr>
                <th>Bảo hành</th>
                <td>{{ $sanpham->bao_hanh_thang }} tháng</td>
            </tr>
            <tr>
                <th>Ảnh đại diện</th>
                <td>
                    @if ($sanpham->anh_dai_dien)
                        <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm" style="max-width: 200px;">
                    @else
                        Không có ảnh
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endsection
