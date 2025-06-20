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
                        <div class="card @if ($address->mac_dinh) border-success @endif">
                            <div class="card-header @if ($address->mac_dinh) bg-success text-white @endif">
                                Địa chỉ @if ($address->mac_dinh)
                                    <span class="badge bg-light text-success">Mặc định</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{ $address->ten_nguoi_nhan }}</h6>
                                <p class="card-text">
                                    <strong>Số điện thoại:</strong> {{ $address->so_dien_thoai_nguoi_nhan }}<br>
                                    <strong>Địa chỉ:</strong> {{ $address->dia_chi_day_du }}, {{ $address->phuong_xa }}, {{ $address->quan_huyen }}, {{ $address->tinh_thanh_pho }}
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('client.addresses.edit', $address) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    @if (!$address->mac_dinh)
                                        <form action="{{ route('client.addresses.setDefault', $address) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-star"></i> Đặt mặc định
                                            </button>
                                        </form>
                                        <form action="{{ route('client.addresses.destroy', $address) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">
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
            <a href="{{ route('client.profile.show') }}" class="btn btn-secondary">Về</a>
        @endif
    </div>
@endsection
