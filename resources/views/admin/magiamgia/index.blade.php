@extends('admin.layouts.app') {{-- Giả sử bạn có layout admin --}}

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Quản lý Mã Giảm Giá</h1>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.magiamgia.create') }}" class="btn btn-primary">Thêm Mã Giảm Giá Mới</a>
                <div class="btn-group">
                    <a href="{{ route('admin.magiamgia.index') }}"
                        class="btn btn-sm {{ !request()->has('status') || request()->status === 'active' ? 'btn-primary' : 'btn-outline-primary' }}">Đang
                        Hoạt Động</a>
                    <a href="{{ route('admin.magiamgia.index', ['status' => 'deleted']) }}"
                        class="btn btn-sm {{ request()->status === 'deleted' ? 'btn-primary' : 'btn-outline-primary' }}">Đã
                        Xóa Mềm</a>
                    <a href="{{ route('admin.magiamgia.index', ['status' => 'all']) }}"
                        class="btn btn-sm {{ request()->status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">Tất
                        Cả</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Loại</th>
                                <th>Giá Trị</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th>Hoạt Động</th>
                                <th>Trạng Thái Xóa</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($maGiamGias as $maGiamGia)
                                <tr>
                                    <td>{{ $maGiamGia->id }}</td>
                                    <td>{{ $maGiamGia->ma }}</td>
                                    <td>{{ $maGiamGia->loai == 'phan_tram' ? 'Phần trăm' : 'Tiền mặt' }}</td>
                                    <td>{{ $maGiamGia->gia_tri }}</td>
                                    <td>{{ $maGiamGia->ngay_bat_dau ? \Carbon\Carbon::parse($maGiamGia->ngay_bat_dau)->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td>{{ $maGiamGia->ngay_ket_thuc ? \Carbon\Carbon::parse($maGiamGia->ngay_ket_thuc)->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($maGiamGia->hoat_dong)
                                            <span class="badge badge-success">Có</span>
                                        @else
                                            <span class="badge badge-danger">Không</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($maGiamGia->deleted_at)
                                            <span class="badge badge-danger">Đã Xóa Mềm</span>
                                        @else
                                            <span class="badge badge-success">Đang Hoạt Động</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($maGiamGia->deleted_at)
                                            {{-- Nút Khôi phục --}}
                                            <form action="{{ route('admin.magiamgia.restore', $maGiamGia->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn khôi phục mã giảm giá này không?')">Khôi
                                                    phục</button>
                                            </form>
                                            {{-- Nút Xóa Vĩnh Viễn (tùy chọn) --}}
                                            <form action="{{ route('admin.magiamgia.forceDelete', $maGiamGia->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn CÓ CHẮC muốn xóa vĩnh viễn mã giảm giá này không? Hành động này không thể hoàn tác!')">Xóa
                                                    Vĩnh Viễn</button>
                                            </form>
                                        @else
                                            {{-- Nút Sửa --}}
                                            <a href="{{ route('admin.magiamgia.edit', $maGiamGia->id) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                            {{-- Nút Xóa (Xóa mềm) --}}
                                            <form action="{{ route('admin.magiamgia.destroy', $maGiamGia->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa mềm mã giảm giá này không?')">Xóa</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Không có mã giảm giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $maGiamGias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
