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
                        <form action="{{ route('client.profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="ten_dang_nhap" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap"
                                    value="{{ old('ten_dang_nhap', auth()->user()->ten_dang_nhap ?? '') }}" required>
                                @error('ten_dang_nhap')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ho_ten" class="form-label">Họ tên</label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                                    value="{{ old('ho_ten', auth()->user()->ho_ten ?? '') }}" required>
                                @error('ho_ten')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                    value="{{ old('so_dien_thoai', auth()->user()->so_dien_thoai ?? '') }}">
                                @error('so_dien_thoai')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
