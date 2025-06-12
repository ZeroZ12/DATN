@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Chỉnh sửa người dùng</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="card p-4 shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Họ tên:</label>
                <input type="text" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại:</label>
                <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tên đăng nhập:</label>
                <input type="text" name="ten_dang_nhap" value="{{ old('ten_dang_nhap', $user->ten_dang_nhap) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái:</label>
                <select name="trang_thai" class="form-select">
                    <option value="hoat_dong" {{ $user->trang_thai == 'hoat_dong' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="vo_hieu" {{ $user->trang_thai == 'vo_hieu' ? 'selected' : '' }}>Vô hiệu</option>
                    <option value="an" {{ $user->trang_thai == 'an' ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            @if (Auth::user()->vai_tro === 'quan_tri' && Auth::id() != $user->id)
                <select name="vai_tro" class="form-select">
                    <option value="quan_tri" {{ $user->vai_tro == 'quan_tri' ? 'selected' : '' }}>quan tri</option>
                    <option value="khach_hang" {{ $user->vai_tro == 'khach_hang' ? 'selected' : '' }}>Khách hàng</option>
                </select>
            @else
                <input type="text" class="form-control" value="{{ $user->vai_tro }}" disabled>
            @endif


            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
