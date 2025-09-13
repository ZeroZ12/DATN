@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <h3>Yêu cầu hoàn tiền - Đơn hàng #{{ $donHang->ma_don }}</h3>


    <form action="{{ route('client.hoan-tra.submit', $donHang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Phương thức hoàn tiền --}}
        <div class="mb-3">
            <label for="phuong_thuc_hoan_tien" class="form-label">Phương thức hoàn tiền <span class="text-danger">*</span></label>
            <select name="phuong_thuc_hoan_tien" id="phuong_thuc_hoan_tien" class="form-select @error('phuong_thuc_hoan_tien') is-invalid @enderror" required>
                <option value="">-- Chọn phương thức --</option>
                <option value="momo" {{ old('phuong_thuc_hoan_tien') == 'momo' ? 'selected' : '' }}>Momo</option>
                <option value="chuyen_khoan" {{ old('phuong_thuc_hoan_tien') == 'chuyen_khoan' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
            </select>
            @error('phuong_thuc_hoan_tien')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ngân hàng (chỉ hiện nếu chuyen_khoan) --}}
        <div id="nganHangField" class="mb-3" style="display: none;">
            <label for="ten_ngan_hang" class="form-label">Ngân hàng <span class="text-danger">*</span></label>
            <select name="ten_ngan_hang" id="ten_ngan_hang" class="form-select @error('ten_ngan_hang') is-invalid @enderror">
                <option value="">-- Chọn ngân hàng --</option>
                <option value="Vietcombank" {{ old('ten_ngan_hang') == 'Vietcombank' ? 'selected' : '' }}>Vietcombank</option>
                <option value="Techcombank" {{ old('ten_ngan_hang') == 'Techcombank' ? 'selected' : '' }}>Techcombank</option>
                <option value="MB Bank" {{ old('ten_ngan_hang') == 'MB Bank' ? 'selected' : '' }}>MB Bank</option>
                <option value="TPBank" {{ old('ten_ngan_hang') == 'TPBank' ? 'selected' : '' }}>TPBank</option>
                <option value="ACB" {{ old('ten_ngan_hang') == 'ACB' ? 'selected' : '' }}>ACB</option>
                <option value="VPBank" {{ old('ten_ngan_hang') == 'VPBank' ? 'selected' : '' }}>VPBank</option>
                <option value="BIDV" {{ old('ten_ngan_hang') == 'BIDV' ? 'selected' : '' }}>BIDV</option>
            </select>
            @error('ten_ngan_hang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Số tài khoản --}}
        <div class="mb-3">
            <label for="so_tai_khoan" class="form-label" id="label-so-tai-khoan">Số tài khoản <span class="text-danger">*</span></label>
            <input type="text" name="so_tai_khoan" id="so_tai_khoan" class="form-control @error('so_tai_khoan') is-invalid @enderror"
                   value="{{ old('so_tai_khoan') }}" required>
            @error('so_tai_khoan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Lý do hoàn tiền --}}
        <div class="mb-3">
            <label for="ly_do" class="form-label">Lý do hoàn tiền <span class="text-danger">*</span></label>

            <!-- select chỉ để chọn, không có name -->
            <select id="ly_do_select" class="form-select @error('ly_do') is-invalid @enderror">
                <option value="">-- Chọn lý do --</option>
                <option value="Sản phẩm lỗi" {{ old('ly_do') == 'Sản phẩm lỗi' ? 'selected' : '' }}>Sản phẩm lỗi</option>
                <option value="Giao nhầm hàng" {{ old('ly_do') == 'Giao nhầm hàng' ? 'selected' : '' }}>Giao nhầm hàng</option>
                <option value="khac" {{ old('ly_do') && !in_array(old('ly_do'), ['Sản phẩm lỗi','Giao nhầm hàng']) ? 'selected' : '' }}>Khác</option>
            </select>

            <!-- textarea gửi giá trị thực sự -->
            <textarea name="ly_do" id="lyDoField" rows="3" class="form-control mt-2 @error('ly_do') is-invalid @enderror" style="display: none;">{{ old('ly_do') }}</textarea>

            @error('ly_do')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ảnh minh chứng (nếu muốn) --}}
        <!-- <div class="mb-3">
            <label for="anh_minh_chung" class="form-label">Ảnh minh chứng (có thể chọn nhiều)</label>
            <input type="file" name="anh_minh_chung[]" id="anh_minh_chung" class="form-control @error('anh_minh_chung.*') is-invalid @enderror" multiple accept="image/*">
            @error('anh_minh_chung.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <button type="submit" class="btn btn-warning">Gửi yêu cầu hoàn tiền</button>
        <a href="{{ route('client.orders.show', $donHang->id) }}" class="btn btn-secondary ms-2">Quay lại</a>
    </form>
</div>
@endsection

@push('js')
<script>
    function toggleFields() {
        // Phương thức hoàn tiền
        const method = document.getElementById('phuong_thuc_hoan_tien').value;
        const nganHangField = document.getElementById('nganHangField');
        const labelSoTK = document.getElementById('label-so-tai-khoan');

        if (method === 'chuyen_khoan') {
            nganHangField.style.display = 'block';
            labelSoTK.textContent = 'Số tài khoản ngân hàng';
        } else {
            nganHangField.style.display = 'none';
            labelSoTK.textContent = 'Số tài khoản Momo';
        }

        // Lý do
        toggleLyDo();
    }

    function toggleLyDo() {
        const select = document.getElementById('ly_do_select');
        const field = document.getElementById('lyDoField');

        if (select.value === 'khac') {
            field.style.display = 'block';
            field.value = '';
        } else if (select.value === '') {
            field.style.display = 'none';
            field.value = '';
        } else {
            field.style.display = 'none';
            field.value = select.value; // gửi luôn giá trị option
        }
    }

    document.getElementById('phuong_thuc_hoan_tien').addEventListener('change', toggleFields);
    document.getElementById('ly_do_select').addEventListener('change', toggleLyDo);
    window.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endpush
