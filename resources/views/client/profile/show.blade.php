{{-- resources/views/client/profile/show.blade.php --}}
@extends('client.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Các tab điều hướng --}}
                <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab"
                            data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info"
                            aria-selected="true">Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-update"
                            type="button" role="tab" aria-controls="password-update" aria-selected="false">Cập nhật mật
                            khẩu</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses"
                            type="button" role="tab" aria-controls="addresses" aria-selected="false">Địa chỉ của
                            tôi</button>
                    </li>
                    {{-- Thêm các tab khác nếu cần --}}
                </ul>

                {{-- Hiển thị thông báo chung (nếu muốn, có thể đặt bên trong từng tab) --}}
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
                {{-- Thông báo riêng cho từng tab có thể được xử lý bằng JS để activate tab --}}


                <div class="tab-content" id="profileTabsContent">
                    {{-- Tab Thông tin cá nhân --}}
                    <div class="tab-pane fade show active" id="personal-info" role="tabpanel"
                        aria-labelledby="personal-info-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Cập Nhật Thông Tin Cá Nhân</h4>
                            </div>
                            <div class="card-body">
                                {{-- Form cập nhật thông tin cá nhân --}}
                                @include('client.profile.partials.update-personal-info-form')
                            </div>
                        </div>
                    </div>

                    {{-- Tab Cập nhật mật khẩu --}}
                    <div class="tab-pane fade" id="password-update" role="tabpanel" aria-labelledby="password-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-white">
                                <h4 class="mb-0">Thay Đổi Mật Khẩu</h4>
                            </div>
                            <div class="card-body">
                                {{-- Form cập nhật mật khẩu --}}
                                @include('client.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>


                    {{-- Tab Địa chỉ của tôi --}}
                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <div class="card shadow-sm">
                            <div
                                class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Danh sách địa chỉ</h4>
                                <a href="{{ route('client.addresses.create') }}" class="btn btn-light btn-sm">Thêm địa chỉ
                                    mới</a>
                            </div>
                            <div class="card-body">
                                @if ($user->diaChiNguoiDungs->isEmpty())
                                    <p>Bạn chưa có địa chỉ nào. Hãy thêm một địa chỉ mới!</p>
                                @else
                                    <ul class="list-group">
                                        @foreach ($user->diaChiNguoiDungs as $address)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $address->ten_nguoi_nhan }}</strong>
                                                    ({{ $address->so_dien_thoai_nguoi_nhan }})
                                                    <br>
                                                    {{ $address->dia_chi_day_du }}, {{ $address->phuong_xa }},
                                                    {{ $address->quan_huyen }}, {{ $address->tinh_thanh_pho }}
                                                    @if ($address->mac_dinh)
                                                        <span class="badge bg-info ms-2">Mặc định</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('client.addresses.edit', $address->id) }}"
                                                        class="btn btn-sm btn-warning me-2">Sửa</a>
                                                    <form action="{{ route('client.addresses.destroy', $address->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này không?');">Xóa</button>
                                                    </form>
                                                    @if (!$address->mac_dinh)
                                                        <form
                                                            action="{{ route('client.addresses.setDefault', $address->id) }}"
                                                            method="POST" class="d-inline ms-2">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-primary">Đặt làm mặc
                                                                định</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Các tab khác --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Script để kích hoạt tab sau khi cập nhật (nếu có thông báo) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var triggerEl = null;

            // Ưu tiên kiểm tra lỗi validation để kích hoạt tab (nếu có lỗi trên form)
            @if ($errors->hasAny(['ho_ten', 'email', 'ten_dang_nhap']))
                triggerEl = document.querySelector('#personal-info-tab');
            @endif

            @if ($errors->hasAny(['current_password', 'password', 'password_confirmation']))
                triggerEl = document.querySelector('#password-tab');
            @endif

            @if (
                $errors->hasAny([
                    'ten_nguoi_nhan',
                    'so_dien_thoai_nguoi_nhan',
                    'dia_chi_day_du',
                    'tinh_thanh_pho',
                    'quan_huyen',
                    'phuong_xa',
                ]))
                triggerEl = document.querySelector('#addresses-tab');
            @endif

            // Nếu triggerEl chưa được gán bởi lỗi validation form, kiểm tra các flash message chung
            if (triggerEl === null) {
                @if (session('status') === 'profile-updated')
                    triggerEl = document.querySelector('#personal-info-tab');
                @elseif (session('status') === 'password-updated')
                    triggerEl = document.querySelector('#password-tab');
                @elseif (session('success') || session('error'))
                    // Đây là nơi bắt lỗi/thông báo thành công từ logic controller (như xóa địa chỉ)
                    triggerEl = document.querySelector('#addresses-tab'); // Giả định là của địa chỉ
                @endif
            }

            // Nếu vẫn không có triggerEl nào được xác định (ví dụ: lần đầu tải trang), mặc định là personal-info-tab
            if (triggerEl === null) {
                triggerEl = document.querySelector('#personal-info-tab');
            }

            // Kích hoạt tab cuối cùng đã xác định
            var profileTabs = new bootstrap.Tab(triggerEl);
            profileTabs.show();
        });
    </script>
@endsection
