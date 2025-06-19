@extends('client.layouts.app') {{-- Hoặc layout chính mà bạn đang sử dụng --}}

@section('content')
    <div class="container">
        <h1>Quản lý Địa chỉ của bạn</h1>

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

        <div class="mb-3">
            <a href="{{ route('client.addresses.create') }}" class="btn btn-primary">Thêm Địa chỉ mới</a>
        </div>

        @if ($addresses->isEmpty())
            <p>Bạn chưa có địa chỉ nào. Vui lòng thêm địa chỉ mới.</p>
        @else
            <div class="row">
                @foreach ($addresses as $address)
                    <div class="col-md-6 mb-4">
                        <div class="card @if ($address->la_mac_dinh) border-success @endif">
                            <div class="card-header @if ($address->la_mac_dinh) bg-success text-white @endif">
                                Địa chỉ @if ($address->la_mac_dinh)
                                    (Mặc định)
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $address->ten_nguoi_nhan }}</h5>
                                <p class="card-text">Điện thoại: {{ $address->so_dien_thoai_nguoi_nhan }}</p>
                                <p class="card-text">Địa chỉ: {{ $address->dia_chi_day_du }}, {{ $address->phuong_xa }},
                                    {{ $address->quan_huyen }}, {{ $address->tinh_thanh_pho }}</p>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="{{ route('client.addresses.edit', $address) }}"
                                        class="btn btn-sm btn-info">Sửa</a>

                                    @if (!$address->la_mac_dinh)
                                        <form action="{{ route('client.addresses.setDefault', $address) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">Đặt làm mặc
                                                định</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('client.addresses.destroy', $address) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?');">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('client.profile.show') }}" class="btn btn-secondary">Về</a>
        @endif
    </div>
@endsection
