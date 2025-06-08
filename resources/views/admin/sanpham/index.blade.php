@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Danh sách sản phẩm</h4>
        <a href="{{ route('admin.sanpham.create') }}" class="btn btn-success">+ Thêm sản phẩm</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Mã SP</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Chip</th>
                <th>Bảo hành</th>
                <th>Hoạt động</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sanphams as $sp)
                <tr>
                    <td>{{ $sp->ten }}</td>
                    <td>{{ $sp->ma_san_pham }}</td>
                    <td>
                        @if($sp->anh_dai_dien)
                            <img src="{{ asset('storage/' . $sp->anh_dai_dien) }}" width="60" alt="Ảnh đại diện">
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>{{ $sp->danhMuc->ten ?? '-' }}</td> <!-- Danh mục -->
                    <td>{{ $sp->thuongHieu->ten ?? '-' }}</td> <!-- Thương hiệu -->
                    <td>{{ $sp->chip->ten ?? '-' }}</td> <!-- Chip -->
                    <td>{{ $sp->bao_hanh_thang }} tháng</td>
                    <td>
                        <span class="badge bg-{{ $sp->hoat_dong ? 'success' : 'secondary' }}">
                            {{ $sp->hoat_dong ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.sanpham.edit', $sp->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.sanpham.destroy', $sp->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hiển thị phân trang nếu có --}}
    {{ $sanphams->links() }}
@endsection
