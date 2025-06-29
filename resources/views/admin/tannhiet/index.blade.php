@extends('admin.layouts.app')

@section('title', 'Quản lý Tản Nhiệt')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary fw-bold">📦 Danh sách Tản Nhiệt</h2>
            <div>
                <a href="{{ route('admin.tannhiet.trash') }}" class="btn btn-outline-secondary me-2">🗑️ Thùng rác</a>
                <a href="{{ route('admin.tannhiet.create') }}" class="btn btn-success">+ Thêm Tản Nhiệt mới</a>
            </div>
        </div>

        <!-- Thông báo thành công -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <!-- Bảng tannhiet -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Loại Tản nhiệt</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($TanNhiets as $tannhiet)
                            <tr>
                                <td>{{ $tannhiet->id }}</td>
                                <td class="fw-semibold">{{ $tannhiet->ten }}</td>
                                @if (!empty($tannhiet->gia_sale)&& $tannhiet->gia_sale > 0 )
                                    {{-- Kiểm tra nếu giá không rỗng --}}
                                    <td>{{ number_format($tannhiet->gia_sale, 0, ',', '.') }} đ</td>
                                @else
                                    <td>{{ number_format($tannhiet->gia, 0, ',', '.') }} đ</td>
                                @endif
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($tannhiet->mo_ta), 100, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.tannhiet.edit', $tannhiet->id) }}" class="btn btn-sm btn-warning me-1">
                                        ✏️ Sửa
                                    </a>
                                    <a href="{{ route('admin.tannhiet.show', $tannhiet->id) }}" class="btn btn-sm btn-info me-1">
                                        👁️ Xem
                                    </a>
                                    <form action="{{ route('admin.tannhiet.destroy', $tannhiet->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa tannhiet này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có Tản nhiệt nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $TanNhiets->links('pagination::bootstrap-5') }}
                    </nav>
                </div>

                <style>
                    .pagination {
                        --bs-pagination-padding-x: 1.1rem;
                        /* Tăng padding ngang một chút */
                        --bs-pagination-padding-y: 0.6rem;
                        /* Tăng padding dọc một chút */
                        --bs-pagination-font-size: 1.1rem;
                        /* Đặt font-size bằng biến CSS của Bootstrap */
                        --bs-pagination-border-radius: 0.75rem;
                        /* Tăng bo góc cho tổng thể pagination */
                        --bs-pagination-bg: #fff;
                        /* Nền trắng mặc định */
                        --bs-pagination-border-color: #dee2e6;
                        /* Màu viền mặc định */
                        --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
                        /* Shadow khi focus (màu đỏ) */

                        /* Hiệu ứng chuyển động mượt mà cho toàn bộ pagination */
                        transition: all 0.3s ease-in-out;
                    }

                    /* Các mục riêng lẻ (page-item) */
                    .pagination .page-item {
                        margin: 0 0.25rem;
                        /* Khoảng cách giữa các nút */
                    }

                    /* Nút phân trang (page-link) */
                    .pagination .page-link {
                        color: #dc3545;
                        /* Màu chữ mặc định là đỏ của bạn */
                        border: 1px solid #dc3545;
                        /* Đặt viền cùng màu chữ */
                        border-radius: 0.5rem;
                        /* Bo góc cho từng nút riêng lẻ */
                        transition: all 0.2s ease-in-out;
                        /* Hiệu ứng chuyển động khi hover */
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                        /* Thêm shadow nhẹ cho mỗi nút */
                    }

                    /* Nút phân trang khi hover */
                    .pagination .page-link:hover {
                        background-color: #dc3545;
                        /* Nền đỏ */
                        color: #fff;
                        /* Chữ trắng */
                        border-color: #dc3545;
                        /* Viền đỏ */
                        transform: translateY(-2px);
                        /* Hiệu ứng nhấc nhẹ lên */
                        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
                        /* Shadow mạnh hơn khi hover */
                    }

                    /* Nút phân trang khi focus (click) */
                    .pagination .page-link:focus {
                        box-shadow: var(--bs-pagination-focus-box-shadow);
                        /* Sử dụng biến Bootstrap */
                    }

                    /* Nút phân trang đang active */
                    .pagination .page-item.active .page-link {
                        background-color: #dc3545;
                        /* Nền đỏ */
                        border-color: #dc3545;
                        /* Viền đỏ */
                        color: #fff;
                        /* Chữ trắng */
                        box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
                        /* Shadow cho nút active */
                    }

                    /* Nút disable (Previous/Next khi không có) */
                    .pagination .page-item.disabled .page-link {
                        color: #6c757d;
                        /* Màu xám cho nút bị disable */
                        border-color: #dee2e6;
                        /* Viền xám nhạt */
                        background-color: #f8f9fa;
                        /* Nền xám rất nhạt */
                        cursor: not-allowed;
                        /* Con trỏ không được phép */
                        box-shadow: none;
                        /* Bỏ shadow */
                        transform: none;
                        /* Bỏ hiệu ứng nhấc */
                    }
                </style>
            </div>
        </div>
    </div>
@endsection