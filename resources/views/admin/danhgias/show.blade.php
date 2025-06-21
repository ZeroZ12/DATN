{{-- resources/views/admin/danhgias/show.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Chi tiết Đánh giá')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Chi tiết Đánh giá</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin Đánh giá #{{ $danhGia->id }}</h6>
                <a href="{{ route('admin.danhgias.index') }}" class="btn btn-secondary btn-sm">Quay lại</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Sản phẩm:</strong></div>
                    <div class="col-md-9">
                        @if ($danhGia->sanPham)
                            {{-- KIỂM TRA ĐIỀU KIỆN TẠI ĐÂY --}}
                            <a href="{{ route('sanpham.show', $danhGia->sanPham->id) }}" target="_blank">
                                {{ $danhGia->sanPham->ten }}
                            </a>
                        @else
                            <span class="text-danger">Sản phẩm đã bị xóa hoặc không tồn tại</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Người đánh giá:</strong></div>
                    <div class="col-md-9">{{ $danhGia->user->ho_ten ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Email:</strong></div>
                    <div class="col-md-9">{{ $danhGia->user->email ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Số sao:</strong></div>
                    <div class="col-md-9">
                        @for ($i = 0; $i < $danhGia->so_sao; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                            <i class="far fa-star text-warning"></i>
                        @endfor
                        ({{ $danhGia->so_sao }})
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Bình luận:</strong></div>
                    <div class="col-md-9">{{ $danhGia->binh_luan ?? 'Không có bình luận' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Trạng thái:</strong></div>
                    <div class="col-md-9">
                        @if ($danhGia->trang_thai == 'cho_duyet')
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                        @elseif ($danhGia->trang_thai == 'da_duyet')
                            <span class="badge bg-success">Đã duyệt</span>
                        @else
                            <span class="badge bg-danger">Từ chối</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Ngày tạo:</strong></div>
                    {{-- <div class="col-md-9">{{ $danhGia->created_at->format('d/m/Y H:i:s') }}</div> --}}
                    <div class="col-md-9">
                        {{ $danhGia->created_at ? $danhGia->created_at->format('d/m/Y H:i:s') : 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Cập nhật cuối:</strong></div>
                    {{-- <div class="col-md-9">{{ $danhGia->updated_at->format('d/m/Y H:i:s') }}</div> --}}
                    <div class="col-md-9">
                        {{ $danhGia->updated_at ? $danhGia->updated_at->format('d/m/Y H:i:s') : 'N/A' }}
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.danhgias.edit', $danhGia->id) }}" class="btn btn-primary">Sửa Đánh giá</a>
                    <form action="{{ route('admin.danhgias.destroy', $danhGia->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">Xóa Đánh giá</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
