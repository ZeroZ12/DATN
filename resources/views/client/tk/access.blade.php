<!-- filepath: resources/views/client/profile.blade.php -->
@extends('client.layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white text-center">
                    <h5 class="mb-0">Thông tin tài khoản</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Họ</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                            @error('first_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                            @error('last_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới (nếu muốn đổi)</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection