@extends('admin.layouts.app')

@section('title', 'Danh sách biến thể sản phẩm')

@section('content')
    <div class="container">
        {{-- Tiêu đề động dựa trên sản phẩm cha được truyền vào --}}
        <h1>Danh sách biến thể của sản phẩm: {{ $sanpham->ten }}</h1>

        <!-- Hiển thị thông báo thành công hoặc lỗi -->
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

        <div class="card shadow-sm mt-4">
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
                    {{-- Duyệt qua các biến thể đang hoạt động của sản phẩm --}}
                    @forelse ($bienthes as $bienthe)
                        <tr>
                            <td>{{ $bienthe->id }}</td>
                            <td>{{ $bienthe->ma_bien_the }}</td>
                            <td>{{ $bienthe->ram->dung_luong ?? 'N/A' }}</td>
                            <td>{{ $bienthe->oCung->dung_luong ?? 'N/A' }}</td>
                            <td>{{ number_format($bienthe->gia) }} VNĐ</td>
                            <td>{{ number_format($bienthe->gia_so_sanh) }} VNĐ</td>
                            <td>{{ $bienthe->ton_kho }}</td>
                            <td>
                                @if ($bienthe->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $bienthe->anh_dai_dien) }}" alt="Ảnh biến thể"
                                        class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="col-action">
                                <div class="action-buttons d-flex flex-column gap-1">
                                    {{-- Nút sửa: route lồng ghép cần cả sanpham_id và bienthe_id --}}
                                    <a href="{{ route('admin.sanpham.bienthe.edit', [$sanpham->id, $bienthe->id]) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    {{-- Form xóa mềm: route lồng ghép cần cả sanpham_id và bienthe_id --}}
                                    <form action="{{ route('admin.sanpham.bienthe.destroy', [$sanpham->id, $bienthe->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mềm biến thể này không?')">Xóa mềm</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Không có biến thể nào đang hoạt động cho sản phẩm này.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $bienthes->links() }}
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
            {{-- Nút "Thêm biến thể mới": route lồng ghép cần sanpham_id --}}
            <a href="{{ route('admin.sanpham.bienthe.create', $sanpham->id) }}" class="btn btn-primary">Thêm biến thể mới cho sản phẩm này</a>
            {{-- Nút quay lại danh sách sản phẩm --}}
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
            {{-- Nút thùng rác biến thể: không lồng ghép --}}
            <a href="{{ route('admin.sanpham.bienthe.trashed') }}" class="btn btn-info">Thùng rác biến thể</a>
        </div>
    </div>
@endsection
