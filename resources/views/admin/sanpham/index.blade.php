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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Chip</th>
                    <th>Mainboard</th>
                    <th>GPU</th>
                    <th>Bảo hành</th>
                    <th>Ảnh đại diện</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanphams as $sanpham)

                    <tr>
                        <td>{{ $sanpham->id }}</td>
                        <td>{{ $sanpham->ten }}</td>
                        <td>{{ $sanpham->ma_san_pham }}</td>
                        <td>{{ $sanpham->danhMuc->ten }}</td>
                        <td>{{ $sanpham->thuongHieu->ten }}</td>
                        <td>{{ $sanpham->chip->ten ?? 'Không có chip' }}</td>
                        <td>{{ $sanpham->mainboard->ten ?? 'Không có mainboard' }}</td>
                        <td>{{ $sanpham->gpu->ten ?? 'Không có GPU' }}</td>
                        <td>{{ $sanpham->bao_hanh_thang }} tháng</td>
                        <td>
                            @if ($sanpham->anh_dai_dien)
                                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm" style="max-width: 100px;">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.bienthe.index', $sanpham->id) }}" class="btn btn-secondary btn-sm">Biến thể</a>
                            <a href="{{ route('admin.sanpham.show', $sanpham->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.sanpham.destroy', $sanpham->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $sanphams->links() }}
        </div>
    </div>
@endsection
