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
                                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm"
                                        class="img-fluid rounded" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons d-flex gap-1 flex-wrap">
                                    {{-- SỬA LẠI ĐƯỜNG DẪN BIẾN THỂ TẠI ĐÂY --}}
                                    <a href="{{ route('admin.sanpham.bienthe.index', $sanpham->id) }}"
                                        class="btn btn-secondary btn-sm" title="Biến thể">
                                        <i class="fas fa-boxes"></i>
                                    </a>
                                    <a href="{{ route('admin.sanpham.show', $sanpham->id) }}" class="btn btn-info btn-sm"
                                        title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning btn-sm"
                                        title="Sửa sản phẩm">
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

            <div class="d-flex justify-content-center my-4">
                <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                    {{ $sanphams->links('pagination::bootstrap-5') }}
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
@endsection