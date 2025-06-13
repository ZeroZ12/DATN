@extends('admin.layouts.app') {{-- Giả sử bạn có layout admin --}}

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Quản lý Phương Thức Thanh Toán</h1>

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
                <a href="{{ route('admin.phuongthucthanhtoan.create') }}" class="btn btn-primary">Thêm Phương Thức Mới</a>
                <div class="btn-group">
                    <a href="{{ route('admin.phuongthucthanhtoan.index') }}"
                        class="btn btn-sm {{ !request()->has('status') || request()->status === 'active' ? 'btn-primary' : 'btn-outline-primary' }}">Đang
                        Hoạt Động</a>
                    <a href="{{ route('admin.phuongthucthanhtoan.index', ['status' => 'deleted']) }}"
                        class="btn btn-sm {{ request()->status === 'deleted' ? 'btn-primary' : 'btn-outline-primary' }}">Đã
                        Xóa Mềm</a>
                    <a href="{{ route('admin.phuongthucthanhtoan.index', ['status' => 'all']) }}"
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
                                <th>Tên Phương Thức</th>
                                <th>Mô Tả</th>
                                <th>Hoạt Động</th>
                                <th>Trạng Thái Xóa</th>
                                <th>Ngày Tạo</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($phuongThucThanhToans as $phuongThuc)
                                <tr>
                                    <td>{{ $phuongThuc->id }}</td>
                                    <td>{{ $phuongThuc->ten }}</td>
                                    <td>{{ Str::limit($phuongThuc->mo_ta, 50) }}</td> {{-- Giới hạn độ dài mô tả --}}
                                    <td>
                                        @if ($phuongThuc->hoat_dong)
                                            <span class="badge badge-success">Có</span>
                                        @else
                                            <span class="badge badge-danger">Không</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($phuongThuc->deleted_at)
                                            <span class="badge badge-danger">Đã Xóa Mềm</span>
                                        @else
                                            <span class="badge badge-success">Đang Hoạt Động</span>
                                        @endif
                                    </td>
                                    <td>{{ $phuongThuc->created_at }}</td>
                                    <td>
                                        @if ($phuongThuc->deleted_at)
                                            {{-- Nút Khôi phục --}}
                                            <form
                                                action="{{ route('admin.phuongthucthanhtoan.restore', $phuongThuc->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn khôi phục phương thức thanh toán này không?')">Khôi
                                                    phục</button>
                                            </form>
                                            {{-- Nút Xóa Vĩnh Viễn (tùy chọn) --}}
                                            <form
                                                action="{{ route('admin.phuongthucthanhtoan.forceDelete', $phuongThuc->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn CÓ CHẮC muốn xóa vĩnh viễn phương thức này không? Hành động này không thể hoàn tác!')">Xóa
                                                    Vĩnh Viễn</button>
                                            </form>
                                        @else
                                            {{-- Nút Sửa --}}
                                            <a href="{{ route('admin.phuongthucthanhtoan.edit', $phuongThuc->id) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                            {{-- Nút Xóa (Xóa mềm) --}}
                                            <form
                                                action="{{ route('admin.phuongthucthanhtoan.destroy', $phuongThuc->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa mềm phương thức thanh toán này không?')">Xóa</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có phương thức thanh toán nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $phuongThucThanhToans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
