@extends('admin.layouts.app')

@section('title', 'Thùng rác biến thể sản phẩm')

@section('content')
    <div class="container">
        <h1>Thùng rác biến thể sản phẩm</h1>

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
                        <th class="col-text">Sản phẩm cha</th> {{-- Thêm cột này để dễ nhận biết --}}
                        <th class="col-ma">Mã Biến Thể</th>
                        <th class="col-text">RAM</th>
                        <th class="col-text">Ổ cứng</th>
                        <th class="col-gia">Giá</th>
                        <th class="col-gia">Tồn kho</th>
                        <th class="col-img">Ảnh đại diện</th>
                        <th class="col-action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Duyệt qua các biến thể đã xóa mềm --}}
                    @forelse ($bienthes as $bienthe)
                        <tr>
                            <td>{{ $bienthe->id }}</td>
                            {{-- Hiển thị tên sản phẩm cha (sử dụng withTrashed() trong controller để lấy sản phẩm cha nếu nó cũng đã bị xóa mềm) --}}
                            <td>{{ $bienthe->sanPham->ten ?? 'Sản phẩm không xác định' }}</td>
                            <td>{{ $bienthe->ma_bien_the }}</td>
                            <td>{{ $bienthe->ram->dung_luong ?? 'N/A' }}</td>
                            <td>{{ $bienthe->oCung->dung_luong ?? 'N/A' }}</td>
                            <td>{{ number_format($bienthe->gia) }} VNĐ</td>
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
                                <span class="badge bg-danger mb-1">Đã xóa mềm</span><br>
                                <div class="action-buttons d-flex flex-column gap-1 mt-1">
                                    {{-- Form khôi phục: route không lồng ghép, chỉ cần bienthe_id. Controller tự động tìm bản ghi đã xóa mềm nhờ ->withTrashed() trên route --}}
                                    <form action="{{ route('admin.sanpham.bienthe.restore', $bienthe->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm w-100"
                                            onclick="return confirm('Bạn có chắc chắn muốn khôi phục biến thể này không?')">Khôi phục</button>
                                    </form>
                                    {{-- Form xóa vĩnh viễn: route không lồng ghép, chỉ cần bienthe_id. Controller tự động tìm bản ghi đã xóa mềm nhờ ->withTrashed() trên route --}}
                                    <form action="{{ route('admin.sanpham.bienthe.forceDelete', $bienthe->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                            onclick="return confirm('Bạn CÓ CHẮC CHẮN muốn xóa VĨNH VIỄN biến thể này không? Hành động này không thể hoàn tác!')">Xóa Vĩnh Viễn</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Thùng rác biến thể đang trống.</td>
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
            {{-- Nút quay lại danh sách biến thể (tổng thể) --}}
            {{-- Điều hướng này hợp lý hơn khi ở trang thùng rác tổng hợp --}}
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại danh sách biến thể</a>
        </div>
    </div>
@endsection
