@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách biến thể sản phẩm: {{ $sanpham->ten }}</h1>

        <!-- Hiển thị thông báo thành công khi xóa hoặc cập nhật biến thể sản phẩm -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Danh sách các biến thể sản phẩm -->
        <h4>Biến thể sản phẩm</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th> <!-- ID biến thể sản phẩm -->
                    <th>Mã biến thể</th> <!-- Mã biến thể -->
                    <th>RAM</th>
                    <th>Ổ Cứng</th>
                    <th>Giá</th>
                    <th>Giá so sánh</th>
                    <th>Tồn kho</th>
                    <th>Ảnh đại diện</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanpham->bienTheSanPham as $bienthe)
                    <tr>
                        <td>{{ $bienthe->id }}</td> <!-- Hiển thị ID biến thể -->
                        <td>{{ $bienthe->ma_bien_the ?? 'Không có' }}</td> <!-- Hiển thị Mã biến thể -->
                        <td>{{ $bienthe->ram->dung_luong ?? 'Không có' }}</td> <!-- Hiển thị RAM -->
                        <td>{{ $bienthe->oCung->loai ?? 'Không có' }} - {{ $bienthe->oCung->dung_luong ?? 'Không có' }}</td> <!-- Hiển thị ổ cứng -->
                        <td>{{ number_format($bienthe->gia, 0, ',', '.') }} VNĐ</td> <!-- Hiển thị Giá -->
                        <td>{{ number_format($bienthe->gia_so_sanh, 0, ',', '.') }} VNĐ</td> <!-- Hiển thị Giá so sánh -->
                        <td>{{ $bienthe->ton_kho }}</td> <!-- Hiển thị Tồn kho -->
                        <td>
                            @if ($bienthe->anh_dai_dien)
                                <img src="{{ asset('storage/' . $bienthe->anh_dai_dien) }}" alt="Ảnh đại diện" width="100">
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                        </td>
                        <td>
                            <!-- Các hành động -->
                            <a href="{{ route('admin.bienthe.edit', $bienthe->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.bienthe.destroy', $bienthe->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa biến thể này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



        <!-- Thêm biến thể sản phẩm -->
        <div style="margin-top: 20px;">
            <a href="{{ route('admin.bienthe.create', $sanpham->id) }}" class="btn btn-success">Thêm biến thể</a>
        </div>
    </div>
@endsection
