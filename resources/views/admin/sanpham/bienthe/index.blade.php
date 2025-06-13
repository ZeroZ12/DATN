@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách biến thể sản phẩm: {{ $sanpham->ten }}</h1>

        <!-- Hiển thị thông báo thành công khi xóa hoặc cập nhật biến thể sản phẩm -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Danh sách các biến thể sản phẩm -->
        <h4>Biến thể sản phẩm</h4>
        <div class="card shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-ma">Mã Biến Thể</th>
                        <th class="col-text">RAM</th>
                        <th class="col-text">Ổ cứng</th>
                        <th class="col-gia">Giá</th>
                        <th class="col-gia">Giá so sánh</th>
                        <th class="col-tonkho">Tồn kho</th>
                        <th class="col-img">Ảnh đại diện</th>
                        <th class="col-action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sanpham->bienTheSanPhams as $bienthe)
                        <tr>
                            <td>{{ $bienthe->id }}</td>
                            <td>{{ $bienthe->ma_bien_the }}</td>
                            <td>{{ $bienthe->ram->dung_luong ?? 'N/A' }} {{ $bienthe->ram->don_vi ?? '' }}</td>
                            <td>{{ $bienthe->oCung->dung_luong ?? 'N/A' }} {{ $bienthe->oCung->loai_o_cung ?? '' }}</td>
                            <td>{{ number_format($bienthe->gia) }} VNĐ</td>
                            <td>{{ number_format($bienthe->gia_so_sanh) }} VNĐ</td>
                            <td>{{ $bienthe->ton_kho }}</td>
                            <td>
                                @if ($bienthe->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $bienthe->anh_dai_dien) }}" alt="Ảnh biến thể"
                                        class="img-fluid rounded">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="col-action">
                                @if ($bienthe->deleted_at)
                                    <span class="badge bg-danger mb-1">Đã xóa mềm</span><br>
                                    <div class="action-buttons">
                                        <form action="{{ route('admin.bienthe.restore', $bienthe->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn khôi phục biến thể này không?')">Khôi
                                                phục</button>
                                        </form>
                                        <form action="{{ route('admin.bienthe.forceDelete', $bienthe->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn CÓ CHẮC CHẮN muốn xóa VĨNH VIỄN biến thể này không? Hành động này không thể hoàn tác!')">Xóa
                                                Vĩnh Viễn</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.bienthe.edit', $bienthe->id) }}"
                                            class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('admin.bienthe.destroy', $bienthe->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa mềm biến thể này không?')">Xóa
                                                mềm</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Không có biến thể nào cho sản phẩm này.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>



        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.bienthe.create', $sanpham->id) }}" class="btn btn-primary">Thêm biến thể mới</a>
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
        </div>
    </div>
@endsection
