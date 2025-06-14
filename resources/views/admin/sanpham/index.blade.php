{{-- resources/views/admin/sanpham/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="container-fluid">
        <h1>Danh sách sản phẩm</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary">➕ Thêm sản phẩm mới</a>
            <a href="{{ route('admin.sanpham.trash') }}" class="btn btn-outline-danger">🗑️ Thùng rác</a>
        </div>

        <div class="card shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Chip</th>
                        <th>Bảo hành</th>
                        <th>Ảnh đại diện</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sanphams as $sanpham)
                        <tr>
                            <td>{{ $sanpham->id }}</td>
                            <td>{{ $sanpham->ten }}</td>
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
                            <td>
                                <div class="action-buttons d-flex gap-1 flex-wrap">
                                    {{-- SỬA LẠI ĐƯỜNG DẪN BIẾN THỂ TẠI ĐÂY --}}
                                    <a href="{{ route('admin.sanpham.bienthe.index', $sanpham->id) }}" class="btn btn-secondary btn-sm" title="Biến thể">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Không có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $sanphams->links() }}
            </div>
        </div>
    </div>
@endsection
