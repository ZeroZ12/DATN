@extends('client.layouts.app') {{-- Hoặc 'client.layouts.app' nếu bạn có layout riêng cho phần client --}}

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Cập Nhật Thông Tin Cá Nhân</h4>
                    </div>

                    <div class="card-body">
                        {{-- Hiển thị thông báo thành công nếu có --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('client.profile.update') }}"> {{-- Sử dụng tên route đã được định nghĩa trong nhóm 'client.' --}}
                            @csrf {{-- Mã bảo vệ chống tấn công CSRF --}}
                            @method('POST') {{-- Phương thức POST là mặc định cho form, không cần @method('PUT') ở đây nếu update là POST --}}

                            {{-- Trường Tên đăng nhập --}}
                            <div class="mb-3">
                                <label for="ten_dang_nhap" class="form-label">Tên Đăng Nhập</label>
                                <input type="text" class="form-control @error('ten_dang_nhap') is-invalid @enderror"
                                    id="ten_dang_nhap" name="ten_dang_nhap"
                                    value="{{ old('ten_dang_nhap', $user->ten_dang_nhap) }}" required autofocus>
                                @error('ten_dang_nhap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Trường Địa Chỉ Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Địa Chỉ Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Trường Họ Tên --}}
                            <div class="mb-3">
                                <label for="ho_ten" class="form-label">Họ Tên</label>
                                <input type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                                    id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}" required>
                                @error('ho_ten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Trường Số Điện Thoại --}}
                            <div class="mb-3">
                                <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                                    id="so_dien_thoai" name="so_dien_thoai"
                                    value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}">
                                @error('so_dien_thoai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4"> {{-- Đường kẻ ngang để phân biệt phần đổi mật khẩu --}}

                            <h5 class="mb-3">Đổi Mật Khẩu (Để trống nếu không muốn thay đổi)</h5>

                            {{-- Trường Mật khẩu mới --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật Khẩu Mới</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Trường Xác nhận mật khẩu mới --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Thông Tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
