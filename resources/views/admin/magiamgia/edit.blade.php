@extends('admin.layouts.app')

@section('title', 'Sửa mã giảm giá')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa mã giảm giá: {{ $maGiamGia->ma }}</h2>

        <form action="{{ route('admin.magiamgia.update', $maGiamGia->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ma" class="form-label">Mã <span class="text-danger">*</span></label>
                <input type="text" name="ma" id="ma" class="form-control" value="{{ old('ma', $maGiamGia->ma) }}">
                @error('ma')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="loai" class="form-label">Loại <span class="text-danger">*</span></label>
                <select name="loai" id="loai" class="form-select">
                    <option value="phan_tram" {{ old('loai', $maGiamGia->loai) == 'phan_tram' ? 'selected' : '' }}>Phần trăm
                    </option>
                    <option value="tien_mat" {{ old('loai', $maGiamGia->loai) == 'tien_mat' ? 'selected' : '' }}>Tiền mặt
                    </option>
                </select>
                @error('loai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gia_tri" class="form-label">Giá trị <span class="text-danger">*</span></label>
                <input type="number" name="gia_tri" id="gia_tri" class="form-control"
                    value="{{ old('gia_tri', $maGiamGia->gia_tri) }}" step="0.01" min="0">
                @error('gia_tri')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu</label>
                <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control"
                    value="{{ old('ngay_bat_dau', !empty($maGiamGia->ngay_bat_dau) ? \Carbon\Carbon::parse($maGiamGia->ngay_bat_dau)->format('Y-m-d') : '') }}">
                @error('ngay_bat_dau')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc</label>
                <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control"
                    value="{{ old('ngay_ket_thuc', !empty($maGiamGia->ngay_ket_thuc) ? \Carbon\Carbon::parse($maGiamGia->ngay_ket_thuc)->format('Y-m-d') : '') }}">
                @error('ngay_ket_thuc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hoat_dong" class="form-label">Hoạt động <span class="text-danger">*</span></label>
                <select name="hoat_dong" id="hoat_dong" class="form-select">
                    <option value="1" {{ old('hoat_dong', $maGiamGia->hoat_dong) ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ !old('hoat_dong', $maGiamGia->hoat_dong) ? 'selected' : '' }}>Không</option>
                </select>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.magiamgia.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection