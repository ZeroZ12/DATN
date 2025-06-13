@extends('admin.layouts.app')

@section('title', 'Thêm mã giảm giá')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thêm mã giảm giá mới</h2>

        <form action="{{ route('admin.magiamgia.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ma" class="form-label">Mã <span class="text-danger">*</span></label>
                <input type="text" name="ma" id="ma" class="form-control" value="{{ old('ma') }}">
                @error('ma')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="loai" class="form-label">Loại <span class="text-danger">*</span></label>
                <select name="loai" id="loai" class="form-select">
                    <option value="phan_tram" {{ old('loai') == 'phan_tram' ? 'selected' : '' }}>Phần trăm</option>
                    <option value="tien_mat" {{ old('loai') == 'tien_mat' ? 'selected' : '' }}>Tiền mặt</option>
                </select>
                @error('loai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gia_tri" class="form-label">Giá trị <span class="text-danger">*</span></label>
                <input type="number" name="gia_tri" id="gia_tri" class="form-control" value="{{ old('gia_tri') }}"
                    step="0.01" min="0">
                @error('gia_tri')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu</label>
                <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control"
                    value="{{ old('ngay_bat_dau') }}">
                @error('ngay_bat_dau')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc</label>
                <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control"
                    value="{{ old('ngay_ket_thuc') }}">
                @error('ngay_ket_thuc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hoat_dong" class="form-label">Hoạt động <span class="text-danger">*</span></label>
                <select name="hoat_dong" id="hoat_dong" class="form-select">
                    <option value="1" {{ old('hoat_dong') == '1' ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ old('hoat_dong') == '0' ? 'selected' : '' }}>Không</option>
                </select>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.magiamgia.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
