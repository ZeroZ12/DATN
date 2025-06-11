@extends('admin.layouts.app')

@section('title','Quản lý sản phẩm')

@section('content')
    <div class="container">
        <h1>Danh sách sản phẩm</h1>

        <!-- Hiển thị thông báo thành công khi xóa hoặc cập nhật sản phẩm -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm mới</a>

        <!-- Table hiển thị danh sách sản phẩm -->
       <!-- CSS điều chỉnh cột -->
<style>
    .table td, .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    .col-id { width: 60px; }
    .col-ten { width: 160px; }
    .col-ma { width: 100px; }
    .col-text { width: 130px; }
    .col-bh { width: 90px; }
    .col-img { width: 120px; }
    .col-action { width: 200px; }
</style>

<!-- Bảng sản phẩm -->
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th class="col-id">#</th>
                <th class="col-ten">Tên sản phẩm</th>
                <th class="col-ma">Mã sản phẩm</th>
                <th class="col-text">Danh mục</th>
                <th class="col-text">Thương hiệu</th>
                <th class="col-text">Chip</th>
                <!-- <th class="col-text">Mainboard</th> -->
                <!-- <th class="col-text">GPU</th> -->
                <th class="col-bh">Bảo hành</th>
                <th class="col-img">Ảnh đại diện</th>
                <th class="col-action">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanphams as $sanpham)
                <tr>
                    <td>{{ $sanpham->id }}</td>
                    <td class="col-ten">{{ $sanpham->ten }}</td>
                    <td>{{ $sanpham->ma_san_pham }}</td>
                    <td>{{ $sanpham->danhMuc->ten }}</td>
                    <td>{{ $sanpham->thuongHieu->ten }}</td>
                    <td>{{ $sanpham->chip->ten ?? 'Không có chip' }}</td>
                    <!-- <td>{{ $sanpham->mainboard->ten ?? 'Không có mainboard' }}</td> -->
                    <!-- <td>{{ $sanpham->gpu->ten ?? 'Không có GPU' }}</td> -->
                    <td>{{ $sanpham->bao_hanh_thang }} tháng</td>
                    <td>
                        @if ($sanpham->anh_dai_dien)
                            <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm" class="img-fluid rounded" style="max-width: 100px;">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td class="col-action">
                        <div class="mb-1 d-flex gap-1">
                            <a href="{{ route('admin.bienthe.index', $sanpham->id) }}" class="btn btn-secondary btn-sm">Biến thể</a>
                            <a href="{{ route('admin.sanpham.show', $sanpham->id) }}" class="btn btn-info btn-sm">Xem</a>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.sanpham.destroy', $sanpham->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Phân trang nếu có --}}
    {{ $sanphams->links() }}
</div>


        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $sanphams->links() }}
        </div>
    </div>
@endsection
