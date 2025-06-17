{{-- resources/views/client/addresses/edit.blade.php --}}

@extends('client.layouts.app') {{-- Hoặc layout chính của bạn --}}

@section('content')
    <div class="container">
        <h2>Chỉnh sửa địa chỉ</h2>

        <form method="POST" action="{{ route('client.addresses.update', $address) }}">
            @csrf
            @method('PUT') {{-- Bắt buộc phải có để Laravel hiểu đây là request PUT/PATCH --}}

            {{-- Trường Họ tên người nhận --}}
            <div class="mb-3">
                <label for="ten_nguoi_nhan" class="form-label">Họ tên người nhận:</label>
                <input type="text" class="form-control @error('ten_nguoi_nhan') is-invalid @enderror" id="ten_nguoi_nhan"
                    name="ten_nguoi_nhan" value="{{ old('ten_nguoi_nhan', $address->ten_nguoi_nhan) }}" required>
                @error('ten_nguoi_nhan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trường Số điện thoại người nhận --}}
            <div class="mb-3">
                <label for="so_dien_thoai_nguoi_nhan" class="form-label">Số điện thoại người nhận:</label>
                <input type="text" class="form-control @error('so_dien_thoai_nguoi_nhan') is-invalid @enderror"
                    id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan"
                    value="{{ old('so_dien_thoai_nguoi_nhan', $address->so_dien_thoai_nguoi_nhan) }}" required>
                @error('so_dien_thoai_nguoi_nhan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Các trường khác của địa chỉ (địa chỉ đầy đủ, tỉnh/thành phố, quận/huyện, phường/xã) --}}
            {{-- Bạn sẽ điền tiếp các trường này tương tự như trên --}}
            <div class="mb-3">
                <label for="dia_chi_day_du" class="form-label">Địa chỉ đầy đủ:</label>
                <input type="text" class="form-control @error('dia_chi_day_du') is-invalid @enderror" id="dia_chi_day_du"
                    name="dia_chi_day_du" value="{{ old('dia_chi_day_du', $address->dia_chi_day_du) }}" required>
                @error('dia_chi_day_du')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tinh_thanh_pho" class="form-label">Tỉnh/Thành phố:</label>
                <input type="text" class="form-control @error('tinh_thanh_pho') is-invalid @enderror" id="tinh_thanh_pho"
                    name="tinh_thanh_pho" value="{{ old('tinh_thanh_pho', $address->tinh_thanh_pho) }}" required>
                @error('tinh_thanh_pho')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quan_huyen" class="form-label">Quận/Huyện:</label>
                <input type="text" class="form-control @error('quan_huyen') is-invalid @enderror" id="quan_huyen"
                    name="quan_huyen" value="{{ old('quan_huyen', $address->quan_huyen) }}" required>
                @error('quan_huyen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phuong_xa" class="form-label">Phường/Xã:</label>
                <input type="text" class="form-control @error('phuong_xa') is-invalid @enderror" id="phuong_xa"
                    name="phuong_xa" value="{{ old('phuong_xa', $address->phuong_xa) }}" required>
                @error('phuong_xa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Checkbox Địa chỉ mặc định --}}
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="mac_dinh" name="mac_dinh" value="1"
                    {{ old('mac_dinh', $address->mac_dinh) ? 'checked' : '' }}>
                <label class="form-check-label" for="mac_dinh">Đặt làm địa chỉ mặc định</label>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật địa chỉ</button>
            <a href="{{ route('client.addresses.index') }}" class="btn btn-secondary">Hủy</a>

            {{-- Hoặc về trang index của addresses nếu bạn giữ nó --}}
        </form>
    </div>
@endsection
