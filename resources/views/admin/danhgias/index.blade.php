
@extends('admin.layouts.app') 

@section('title', 'Quản lý Đánh giá sản phẩm')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý Đánh giá sản phẩm</h1>

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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách Đánh giá</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Người đánh giá</th>
                                <th>Số sao</th>
                                <th>Bình luận</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($danhGias as $danhGia)
                                <tr>
                                    <td>{{ $danhGia->id }}</td>
                                    <td>
                                        <a href="{{ route('sanpham.show', $danhGia->sanPham->id) }}" target="_blank">
                                            {{ $danhGia->sanPham->ten ?? 'Sản phẩm không tồn tại' }}
                                        </a>
                                    </td>
                                    <td>{{ $danhGia->user->ho_ten ?? 'Người dùng không tồn tại' }}</td>
                                    <td>
                                        @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                            <i class="far fa-star text-warning"></i>
                                        @endfor
                                        ({{ $danhGia->so_sao }})
                                    </td>
                                    <td>{{ Str::limit($danhGia->binh_luan, 50, '...') }}</td>
                                    <td>
                                        @if ($danhGia->trang_thai == 'cho_duyet')
                                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                        @elseif ($danhGia->trang_thai == 'da_duyet')
                                            <span class="badge bg-success">Đã duyệt</span>
                                        @else
                                            <span class="badge bg-danger">Từ chối</span>
                                        @endif
                                    </td>
                                    <td>{{ $danhGia->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.danhgias.show', $danhGia->id) }}" class="btn btn-info btn-sm mb-1" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.danhgias.edit', $danhGia->id) }}" class="btn btn-primary btn-sm mb-1" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if ($danhGia->trang_thai == 'cho_duyet' || $danhGia->trang_thai == 'tu_choi')
                                            <form action="{{ route('admin.danhgias.approve', $danhGia->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm mb-1" title="Duyệt">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($danhGia->trang_thai == 'cho_duyet' || $danhGia->trang_thai == 'da_duyet')
                                            <form action="{{ route('admin.danhgias.reject', $danhGia->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm mb-1" title="Từ chối">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.danhgias.destroy', $danhGia->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có đánh giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $danhGias->links('pagination::bootstrap-5') }} {{-- Sử dụng phân trang Bootstrap 5 --}}
                </div>
            </div>
        </div>
    </div>
@endsection