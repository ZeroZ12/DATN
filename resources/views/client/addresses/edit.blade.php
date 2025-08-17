@extends('client.layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa địa chỉ</h2>

    <form method="POST" action="{{ route('client.addresses.update', $address) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ten_nguoi_nhan" class="form-label">Họ tên người nhận:</label>
            <input type="text" class="form-control @error('ten_nguoi_nhan') is-invalid @enderror" id="ten_nguoi_nhan"
                name="ten_nguoi_nhan" value="{{ old('ten_nguoi_nhan', $address->ten_nguoi_nhan) }}" required>
            @error('ten_nguoi_nhan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="so_dien_thoai_nguoi_nhan" class="form-label">Số điện thoại người nhận:</label>
            <input type="text" class="form-control @error('so_dien_thoai_nguoi_nhan') is-invalid @enderror"
                id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan"
                value="{{ old('so_dien_thoai_nguoi_nhan', $address->so_dien_thoai_nguoi_nhan) }}" required>
            @error('so_dien_thoai_nguoi_nhan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dia_chi_day_du" class="form-label">Địa chỉ đầy đủ (Số nhà, tên đường, thôn, xóm...):</label>
            <textarea class="form-control @error('dia_chi_day_du') is-invalid @enderror" id="dia_chi_day_du"
                name="dia_chi_day_du" rows="3" required>{{ old('dia_chi_day_du', $address->dia_chi_day_du) }}</textarea>
            @error('dia_chi_day_du')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tinh_thanh_pho" class="form-label">Tỉnh/Thành phố:</label>
            <select class="form-control" id="tinh_thanh_pho" name="tinh_thanh_pho" required>
                <option value="">-- Chọn Tỉnh/Thành phố --</option>
            </select>
        </div>

        {{-- <div class="mb-3">
            <label for="quan_huyen" class="form-label">Quận/Huyện:</label>
            <select class="form-control" id="quan_huyen" name="quan_huyen" required>
                <option value="">-- Chọn Quận/Huyện --</option>
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="phuong_xa" class="form-label">Phường/Xã:</label>
            <select class="form-control" id="phuong_xa" name="phuong_xa" required>
                <option value="">-- Chọn Phường/Xã --</option>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="mac_dinh" name="mac_dinh" value="1"
                {{ old('mac_dinh', $address->mac_dinh) ? 'checked' : '' }}>
            <label class="form-check-label" for="mac_dinh">Đặt làm địa chỉ mặc định</label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật địa chỉ</button>
        <a href="{{ route('client.addresses.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection

@push('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tinhSelect = document.getElementById('tinh_thanh_pho');
    // const huyenSelect = document.getElementById('quan_huyen');
    const xaSelect = document.getElementById('phuong_xa');

    let tinhData = {};
    // let huyenData = {};
    let xaData = {};

    const tinhOld = "{{ old('tinh_thanh_pho', $address->tinh_thanh_pho) }}";
    // const huyenOld = "{{ old('quan_huyen', $address->quan_huyen) }}";
    const xaOld = "{{ old('phuong_xa', $address->phuong_xa) }}";

    fetch('{{ asset('assets/data/tinh_tp.json') }}')
        .then(res => res.json())
        .then(data => {
            tinhData = data;
            Object.values(tinhData).forEach(tinh => {
                tinhSelect.innerHTML += `<option value="${tinh.code}" ${tinhOld == tinh.code ? 'selected' : ''}>${tinh.name}</option>`;
            });
            if (tinhOld) {
                loadXa(tinhOld);
            }
        });

    tinhSelect.addEventListener('change', function() {
        loadXa(this.value);
    });

    // function loadHuyen(tinhId) {
    //     huyenSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
    //     xaSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';

    //     if (!tinhId) return;

    //     fetch('{{ asset('assets/data/quan_huyen.json') }}')
    //         .then(res => res.json())
    //         .then(data => {
    //             huyenData = data;
    //             Object.values(huyenData).forEach(huyen => {
    //                 if (huyen.parent_code == tinhId) {
    //                     huyenSelect.innerHTML += `<option value="${huyen.code}" ${huyenOld == huyen.code ? 'selected' : ''}>${huyen.name_with_type}</option>`;
    //                 }
    //             });
    //             if (huyenOld) {
    //                 loadXa(huyenOld);
    //             }
    //         });
    // }

    // huyenSelect.addEventListener('change', function() {
    //     loadXa(this.value);
    // });

    function loadXa(tinhId) {
        xaSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';

        if (!tinhId) return;

        fetch('{{ asset('assets/data/xa_phuong.json') }}')
            .then(res => res.json())
            .then(data => {
                xaData = data;
                Object.values(xaData).forEach(xa => {
                    if (xa.parent_code == tinhId) {
                        xaSelect.innerHTML += `<option value="${xa.code}" ${xaOld == xa.code ? 'selected' : ''}>${xa.name}</option>`;
                    }
                });
            });
    }
});
</script>
@endpush
