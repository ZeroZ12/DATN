@extends('admin.layouts.app')

@section('title', 'Quản lý banner')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📂 Danh sách tất cả banner</h2>
            <div>
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary me-2" title="Banner"><i class="fa fa-image"
                        aria-hidden="true"></i></a>
                <a href="{{ route('admin.banner.trashed') }}" class="btn btn-secondary me-2" title="Thùng rác"><i
                        class="fa fa-trash" aria-hidden="true"></i></a>
                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary" title="Thêm mới"><i
                        class="fa fa-plus-square" aria-hidden="true"></i></a>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên banner</th>
                            <th>Ảnh</th>
                            <th>Giảm giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td class="text-center">{{ $banner->id }}</td>
                                <td class="text-center">{{ $banner->title }}</td>
                                <td class="text-center image_banner">
                                    @if ($banner->image_url)
                                        <img class="w-100 h-100" src="{{ asset('storage/' . $banner->image_url) }}"
                                            alt="Ảnh lỗi">
                                    @else
                                        <span>Không có ảnh</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $banner->sale }}</td>

                                <td class="text-center">
                                    @if ($banner->deleted_at)
                                        <div class="hide badge badge-warning">
                                            Vô hiệu
                                        </div>
                                    @else
                                        <div class="show badge badge-success">
                                            Hoạt động
                                        </div>
                                    @endif
                                </td>
                                @if ($banner->deleted_at)
                                    <td class="text-center d-flex justify-content-center align-items-center gap-1" style="height: 100%;">
                                        <form action="{{ route('admin.banner.restore', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0"
                                              data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="restore" data-id="{{ $banner->id }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Khôi phục"><i
                                                    class="fa fa-reply" aria-hidden="true"></i></button>
                                        </form>
                                        <form action="{{ route('admin.banner.forceDelete', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0"
                                              data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="force-delete" data-id="{{ $banner->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa vĩnh viễn"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                @else
                                    <td class="text-center d-flex justify-content-center align-items-center gap-1" style="height: 100%;">
                                        <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                           class="btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"
                                                                                       aria-hidden="true"></i></a>
                                        <a href="{{ route('admin.banner.show', $banner->id) }}"
                                           class="btn btn-sm btn-info" title="Chi tiết"><i class="fa fa-eye"
                                                                                          aria-hidden="true"></i></a>
                                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                              class="d-inline-block m-0 p-0"
                                              data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="soft-delete" data-id="{{ $banner->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa mềm"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Chưa có banner nào.
                                    <a href="{{ route('admin.banner.trashed') }}">Xem các banner đã xóa mềm?</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center my-4">
                <nav aria-label="Page navigation example">
                    {{ $banners->links('pagination::bootstrap-5') }}
                </nav>
            </div>

            <!-- Modal xác nhận -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Xác nhận hành động</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="confirmMessage">Bạn có chắc muốn thực hiện hành động này?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" id="confirmActionBtn">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .pagination {
                    --bs-pagination-padding-x: 1.1rem;
                    --bs-pagination-padding-y: 0.6rem;
                    --bs-pagination-font-size: 1.1rem;
                    --bs-pagination-border-radius: 0.75rem;
                    --bs-pagination-bg: #fff;
                    --bs-pagination-border-color: #dee2e6;
                    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
                    transition: all 0.3s ease-in-out;
                }

                .pagination .page-item {
                    margin: 0 0.25rem;
                }

                .pagination .page-link {
                    color: #dc3545;
                    border: 1px solid #dc3545;
                    border-radius: 0.5rem;
                    transition: all 0.2s ease-in-out;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                }

                .pagination .page-link:hover {
                    background-color: #dc3545;
                    color: #fff;
                    border-color: #dc3545;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
                }

                .pagination .page-link:focus {
                    box-shadow: var(--bs-pagination-focus-box-shadow);
                }

                .pagination .page-item.active .page-link {
                    background-color: #dc3545;
                    border-color: #dc3545;
                    color: #fff;
                    box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
                }

                .pagination .page-item.disabled .page-link {
                    color: #6c757d;
                    border-color: #dee2e6;
                    background-color: #f8f9fa;
                    cursor: not-allowed;
                    box-shadow: none;
                    transform: none;
                }

                .image_banner {
                    width: 240px;
                    height: 120px;
                }

                /* Căn chỉnh nút hành động */
                .table td.d-flex {
                    gap: 0.5rem;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .table td.d-flex .btn {
                    min-width: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .table td.d-flex form {
                    margin: 0;
                    padding: 0;
                    display: inline-flex;
                }
                .table td.d-flex button {
                    padding: 0.25rem 0.5rem;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                /* Tùy chỉnh modal */
                #confirmModal .modal-content {
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                }

                #confirmModal .modal-header {
                    border-bottom: 1px solid #eee;
                    background: #fff;
                }

                #confirmModal .modal-title {
                    font-weight: 600;
                    color: #333;
                }

                #confirmModal .modal-body {
                    font-size: 16px;
                    color: #555;
                    padding: 20px;
                }

                #confirmModal .modal-footer {
                    border-top: 1px solid #eee;
                    padding: 15px;
                    justify-content: flex-end;
                }

                #confirmModal .btn {
                    border-radius: 8px;
                    padding: 8px 20px;
                    font-weight: 500;
                }

                #confirmModal .btn-secondary {
                    background: #6c757d;
                    color: #fff;
                    border: none;
                }

                #confirmModal .btn-secondary:hover {
                    background: #5a6268;
                }

                #confirmModal .btn-danger {
                    background: #dc3545;
                    color: #fff;
                    border: none;
                }

                #confirmModal .btn-danger:hover {
                    background: #c82333;
                }
            </style>
        </div>
    </div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const confirmModal = document.getElementById('confirmModal');
    if (confirmModal) {
        confirmModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const type = button.getAttribute('data-type');
            const id = button.getAttribute('data-id');
            const form = button.closest('form');

            const modalBody = confirmModal.querySelector('.modal-body #confirmMessage');
            const confirmBtn = confirmModal.querySelector('#confirmActionBtn');

            if (type === 'restore') {
                modalBody.textContent = 'Bạn có chắc muốn khôi phục banner này?';
                confirmBtn.onclick = function() {
                    form.submit();
                };
            } else if (type === 'force-delete') {
                modalBody.textContent = 'Bạn CÓ CHẮC chắn muốn XÓA VĨNH VIỄN banner này?';
                confirmBtn.onclick = function() {
                    form.submit();
                };
            } else if (type === 'soft-delete') {
                modalBody.textContent = 'Bạn có chắc muốn xóa mềm banner này?';
                confirmBtn.onclick = function() {
                    form.submit();
                };
            }

            confirmBtn.setAttribute('data-type', type);
            confirmBtn.setAttribute('data-id', id || '');
        });

        confirmModal.addEventListener('hide.bs.modal', function() {
            const confirmBtn = confirmModal.querySelector('#confirmActionBtn');
            confirmBtn.onclick = null;
            confirmBtn.removeAttribute('data-type');
            confirmBtn.removeAttribute('data-id');
        });
    }
});
</script>
@endpush