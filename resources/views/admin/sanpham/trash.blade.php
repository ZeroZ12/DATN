@extends('admin.layouts.app')

@section('title', 'Thùng Rác Sản Phẩm')

@section('content')
<div class="container mt-4">
    <h2> Thùng rác - Danh sách sản phẩm đã xóa</h2>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.sanpham.index') }}" class="btn btn-primary mb-3">Quay lại</a>

   <div class="card shadow-sm">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Id</th>
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
            @forelse ($trashedSanPhams as $sanpham)
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
                            {{-- Khôi phục --}}
                            <form action="{{ route('admin.sanpham.restore', $sanpham->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" title="Khôi phục sản phẩm">
                                    <i class="fas fa-undo-alt"></i>
                                </button>
                            </form>

                            {{-- Xóa vĩnh viễn --}}
                            {{-- <form action="{{ route('admin.sanpham.forceDelete', $sanpham->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Xóa vĩnh viễn"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Không có sản phẩm đã xóa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trashedSanPhams->links() }}
    </div>
</div>


    <div>
        {{ $trashedSanPhams->links() }}
    </div>
</div>
@endsection


