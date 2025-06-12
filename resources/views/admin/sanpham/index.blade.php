{{-- resources/views/admin/sanpham/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="container-fluid">
        <h1>Danh sách sản phẩm</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm mới</a>
        <div class="card shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-ten">Tên sản phẩm</th>
                        <th class="col-ma">Mã sản phẩm</th>
                        <th class="col-text">Danh mục</th>
                        <th class="col-text">Thương hiệu</th>
                        <th class="col-text">Chip</th>
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
                            <td>{{ $sanpham->danhMuc->ten ?? 'N/A' }}</td>
                            <td>{{ $sanpham->thuongHieu->ten ?? 'N/A' }}</td>
                            <td>{{ $sanpham->chip->ten ?? 'N/A' }}</td>
                            <td>{{ $sanpham->bao_hanh_thang }} tháng</td>
                            <td>
                                @if ($sanpham->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm" class="img-fluid rounded" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="col-action">
                                @if ($sanpham->deleted_at)
                                    {{-- Hiển thị khi sản phẩm đã xóa mềm --}}
                                    <span class="badge bg-danger mb-1">Đã xóa mềm</span><br>
                                    <div class="action-buttons d-flex gap-1 flex-wrap mt-1">
                                        <form action="{{ route('admin.sanpham.restore', $sanpham->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" title="Khôi phục"
                                                onclick="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này không?')">
                                                <i class="fas fa-undo-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.sanpham.forceDelete', $sanpham->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa vĩnh viễn"
                                                onclick="return confirm('Bạn CÓ CHẮC CHẮN muốn xóa VĨNH VIỄN sản phẩm này không? Hành động này không thể hoàn tác!')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Hiển thị khi sản phẩm đang hoạt động --}}
                                    <div class="action-buttons d-flex gap-1 flex-wrap">
                                        <a href="{{ route('admin.bienthe.index', $sanpham->id) }}" class="btn btn-secondary btn-sm" title="Biến thể">
                                            <i class="fas fa-boxes"></i>
                                        </a>
                                        <a href="{{ route('admin.sanpham.show', $sanpham->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning btn-sm" title="Sửa sản phẩm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sanpham.destroy', $sanpham->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa mềm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa mềm sản phẩm này không?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-center">
                {{ $sanphams->links() }}
            </div>
        </div>
    </div>
@endsection
