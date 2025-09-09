@extends('admin.layouts.app')

@section('title', 'Quản lý Sự Kiện')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary fw-bold">✨
                 Danh sách Sự Kiện</h2>
            <div>
                <a href="{{ route('admin.sukien.trashed') }}" class="btn btn-outline-secondary me-2">🗑️ Thùng rác</a>
                <a href="{{ route('admin.sukien.create') }}" class="btn btn-success">+ Thêm Sự Kiện mới</a>
            </div>
        </div>

        <!-- Thông báo thành công -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <!-- Bảng suKien -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Tên sự kiện</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Sản phẩm</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($saleEvents as $suKien)
                            <tr>
                                <td>{{ $suKien->id }}</td>
                                <td class="fw-semibold">{{ $suKien->ten_su_kien }}</td>
                                <td>{{ $suKien->ngay_bat_dau->format('d/m/Y H:i') }}</td>
                                <td>{{ $suKien->ngay_ket_thuc->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($suKien->total > 0)
                                        <span>Số lượng sản phẩm: {{ $suKien->total }}</span>
                                        @if($suKien->sanPhams->isNotEmpty())
                                            <button type="button" class="btn btn-sm btn-link text-info p-0 ms-2" data-bs-toggle="tooltip" data-bs-title="{{ $suKien->sanPhams->pluck('ten')->join(', ') }}">
                                                (Xem chi tiết)
                                            </button>
                                        @endif
                                    @else
                                        <span class="text-muted">Chưa có sản phẩm</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    if ($suKien->hien_thi == 1) {
                                        $now = now();
                                        $isActive = $suKien->hien_thi == 1 && $now->between($suKien->ngay_bat_dau, $suKien->ngay_ket_thuc);
                                    } else {
                                        $isActive = false;
                                    }
                                    @endphp
                                    <span class="badge {{ $isActive ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $isActive ? 'Đang diễn ra' : 'Ngừng diễn ra' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.sukien.edit', $suKien->id) }}" class="btn btn-sm btn-warning me-1">
                                        ✏️ Sửa
                                    </a>
                                    <a href="{{ route('admin.sukien.show', $suKien->id) }}" class="btn btn-sm btn-info me-1">
                                        👁️ Xem
                                    </a>
                                    <form action="{{ route('admin.sukien.destroy', $suKien->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa sự kiện này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                    <form action="{{ route('admin.sukien.toggle-display', $suKien->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn {{ $suKien->hien_thi == 1 ? 'ẩn' : 'hiển thị' }} sự kiện này?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $suKien->hien_thi == 1 ? 'btn-secondary' : 'btn-primary' }}" data-bs-toggle="tooltip" data-bs-title="{{ $suKien->hien_thi == 1 ? 'Ẩn sự kiện' : 'Hiển thị sự kiện' }}">
                                            @if ($suKien->hien_thi == 1)
                                                👁️ Ẩn
                                            @else
                                                👁️ Hiện
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có Sự Kiện nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $saleEvents->links('pagination::bootstrap-5') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('css-custom')
    <style>
        .btn-group .btn {
            padding: 0.25rem 0.5rem;
        }
    </style>
@endsection

@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection