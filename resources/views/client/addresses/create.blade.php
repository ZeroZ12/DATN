@extends('client.layouts.app') {{-- Hoặc layout chính mà bạn đang sử dụng --}}

@section('content')
<div class="container">
    <h1>Thêm Địa chỉ mới</h1>

    <form action="{{ route('client.addresses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="ten_nguoi_nhan" class="form-label">Tên người nhận:</label>
            <input type="text" class="form-control @error('ten_nguoi_nhan') is-invalid @enderror" id="ten_nguoi_nhan" name="ten_nguoi_nhan" value="{{ old('ten_nguoi_nhan') }}">
            @error('ten_nguoi_nhan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="so_dien_thoai_nguoi_nhan" class="form-label">Số điện thoại người nhận:</label>
            <input type="number" class="form-control @error('so_dien_thoai_nguoi_nhan') is-invalid @enderror" id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan" value="{{ old('so_dien_thoai_nguoi_nhan') }}">
            @error('so_dien_thoai_nguoi_nhan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dia_chi_day_du" class="form-label">Địa chỉ đầy đủ (Số nhà, tên đường, thôn, xóm...):</label>
            <textarea class="form-control @error('dia_chi_day_du') is-invalid @enderror" id="dia_chi_day_du" name="dia_chi_day_du" rows="3">{{ old('dia_chi_day_du') }}</textarea>
            @error('dia_chi_day_du')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tinh_thanh_pho" class="form-label">Tỉnh/Thành phố:</label>
            <input type="text" class="form-control @error('tinh_thanh_pho') is-invalid @enderror" id="tinh_thanh_pho" name="tinh_thanh_pho" value="{{ old('tinh_thanh_pho') }}">
            @error('tinh_thanh_pho')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quan_huyen" class="form-label">Quận/Huyện:</label>
            <input type="text" class="form-control @error('quan_huyen') is-invalid @enderror" id="quan_huyen" name="quan_huyen" value="{{ old('quan_huyen') }}">
            @error('quan_huyen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phuong_xa" class="form-label">Phường/Xã:</label>
            <input type="text" class="form-control @error('phuong_xa') is-invalid @enderror" id="phuong_xa" name="phuong_xa" value="{{ old('phuong_xa') }}">
            @error('phuong_xa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if($isFirstAddress)
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="mac_dinh_first" name="mac_dinh" value="1" checked disabled>
                <label class="form-check-label" for="mac_dinh_first">Đặt làm địa chỉ mặc định (Bạn phải có ít nhất một địa chỉ mặc định)</label>
                <input type="hidden" name="mac_dinh" value="1">
            </div>
        @else
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="mac_dinh" name="mac_dinh" value="1" {{ old('mac_dinh') ? 'checked' : '' }}>
                <label class="form-check-label" for="mac_dinh">Đặt làm địa chỉ mặc định</label>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Thêm Địa chỉ</button>
        <a href="{{ route('client.addresses.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
