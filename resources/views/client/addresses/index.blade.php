@extends('client.layouts.app')

@section('content')
    <div class="container">
        <h1>Quản lý Địa chỉ của bạn</h1>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Nút thêm địa chỉ --}}
        <div class="mb-3">
            <a href="{{ route('client.addresses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm Địa chỉ mới
            </a>
        </div>

        {{-- Danh sách địa chỉ --}}
        @if ($addresses->isEmpty())
            <p>Bạn chưa có địa chỉ nào. Vui lòng thêm địa chỉ mới.</p>
        @else
            <div class="row">
                @foreach ($addresses as $address)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow @if ($address->mac_dinh) border-success @endif">
                            <div
                                class="card-header d-flex justify-content-between align-items-center @if ($address->mac_dinh) bg-success text-white @endif">
                                <strong>Địa chỉ {{ $loop->iteration }}</strong>
                                @if ($address->mac_dinh)
                                    <span class="badge bg-light text-success">Mặc định</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <p class="mb-1">
                                    <strong>Tên người nhận:</strong> {{ $address->ten_nguoi_nhan }}
                                </p>
                                <p class="mb-1">
                                    <strong>Số điện thoại:</strong> {{ $address->so_dien_thoai_nguoi_nhan }}
                                </p>
                                <p class="mb-1">
                                    <strong>Địa chỉ chi tiết:</strong> {{ $address->dia_chi_day_du }}
                                </p>
                                <p class="mb-1">
                                    <strong>Phường/Xã:</strong> {{ $address->phuong_xa_name }} <br>
                                    <strong>Tỉnh/Thành phố:</strong> {{ $address->tinh_thanh_pho_name }}

                                </p>

                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('client.addresses.edit', $address) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>

                                    @if (!$address->mac_dinh)
                                        <form action="{{ route('client.addresses.setDefault', $address) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-star"></i> Đặt mặc định
                                            </button>
                                        </form>

                                        <form action="{{ route('client.addresses.destroy', $address) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('client.profile.show') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Về trang cá nhân
            </a>

            <a href="{{ route('client.cart.checkout') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Về trang đơn hàng
            </a>
        @endif
    </div>
@endsection
