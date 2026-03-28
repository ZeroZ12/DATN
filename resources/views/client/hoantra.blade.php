@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <h3>Yêu cầu hoàn trả đơn hàng #{{ $donHang->ma_don }}</h3>

    @if (session('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif

   <form action="{{ route('client.hoan-tra.store', $donHang->id) }}" method="POST" enctype="multipart/form-data" id="returnForm">
    @csrf

    {{-- Hiển thị tất cả lỗi chung --}}
    <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    {{-- Số điện thoại liên hệ --}}
    <div class="mb-3">
        <label for="sdt_lien_he" class="form-label">Số điện thoại liên hệ</label>
        <input type="text" name="sdt_lien_he" id="sdt_lien_he" class="form-control"
               value="{{ old('sdt_lien_he', auth()->user()->sdt ?? '') }}">
        @error('sdt_lien_he')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Phương thức hoàn tiền --}}
    <div class="mb-3">
        <label for="phuong_thuc_hoan_tien" class="form-label">Phương thức hoàn tiền</label>
        <select name="phuong_thuc_hoan_tien" id="phuong_thuc_hoan_tien" class="form-select">
            <option value="">-- Chọn --</option>
            <option value="momo" {{ old('phuong_thuc_hoan_tien') == 'momo' ? 'selected' : '' }}>Momo</option>
            <option value="bank_transfer" {{ old('phuong_thuc_hoan_tien') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
        </select>
        @error('phuong_thuc_hoan_tien')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Số điện thoại Momo (ẩn/hiện theo chọn) --}}
    <div id="momoField" class="mb-3" style="display: none;">
        <label for="so_dien_thoai_momo" class="form-label">Số điện thoại Momo</label>
        <input type="text" name="so_dien_thoai_momo" id="so_dien_thoai_momo" class="form-control"
               value="{{ old('so_dien_thoai_momo') }}">
        @error('so_dien_thoai_momo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Ngân hàng (ẩn/hiện theo chọn) --}}
    <div id="nganHangField" class="mb-3" style="display: none;">
        <label for="ten_ngan_hang" class="form-label">Ngân hàng</label>
        <select name="ten_ngan_hang" id="ten_ngan_hang" class="form-select">
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
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Số tài khoản --}}
    <div class="mb-3">
        <label for="so_tai_khoan" class="form-label">Số tài khoản</label>
        <input type="text" name="so_tai_khoan" id="so_tai_khoan" class="form-control"
               value="{{ old('so_tai_khoan') }}">
        @error('so_tai_khoan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Chủ tài khoản --}}
    <div class="mb-3">
        <label for="ten_chu_tai_khoan" class="form-label">Chủ tài khoản</label>
        <input type="text" name="ten_chu_tai_khoan" id="ten_chu_tai_khoan" class="form-control"
               value="{{ old('ten_chu_tai_khoan') }}">
        @error('ten_chu_tai_khoan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Lý do --}}
    <div class="mb-3">
        <label for="ly_do" class="form-label">Lý do hoàn trả</label>
        <textarea name="ly_do" id="ly_do" rows="4" class="form-control">{{ old('ly_do') }}</textarea>
        @error('ly_do')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Ảnh minh chứng --}}
    <div class="mb-3">
        <label for="anh_minh_chung" class="form-label">Ảnh minh chứng (có thể chọn nhiều)</label>
        <input type="file" name="anh_minh_chung[]" id="anh_minh_chung" class="form-control" multiple accept="image/*">
        @error('anh_minh_chung')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @error('anh_minh_chung.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-warning" type="submit">
        <i class="fas fa-undo"></i> Gửi yêu cầu hoàn trả
    </button>
    <a href="{{ route('client.profile.show', ['tab' => 'orders']) }}" class="btn btn-secondary ms-2">Quay lại</a>
</form>
</div>
@endsection

@push('js')
<script>
    function toggleFields() {
        const method = document.getElementById('phuong_thuc_hoan_tien').value;
        const nganHangField = document.getElementById('nganHangField');

        const labelSoTK = document.getElementById('label-so-tai-khoan');
        const labelChuTK = document.getElementById('label-ten-chu-tai-khoan');

        if (method === 'momo') {
            nganHangField.style.display = 'none';
            labelSoTK.textContent = 'Số tài khoản Momo';
            labelChuTK.textContent = 'Chủ tài khoản Momo';
        } else if (method === 'bank_transfer') {
            nganHangField.style.display = 'block';
            labelSoTK.textContent = 'Số tài khoản ngân hàng';
            labelChuTK.textContent = 'Chủ tài khoản ngân hàng';
        } else {
            nganHangField.style.display = 'none';
            labelSoTK.textContent = 'Số tài khoản';
            labelChuTK.textContent = 'Chủ tài khoản';
        }
    }

    document.getElementById('phuong_thuc_hoan_tien').addEventListener('change', toggleFields);
    window.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endpush


