@extends('admin.layouts.app')

@section('title', 'Thêm phương thức thanh toán')

@section('content')
    <h2>Thêm phương thức thanh toán mới</h2>

    <form action="{{ route('admin.phuongthucthanhtoan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">Tên phương thức <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control" value="{{ old('ten') }}">
            @error('ten')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô tả</label>
            <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
            @error('mo_ta')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hoat_dong" class="form-label">Hoạt động <span class="text-danger">*</span></label>
            <select name="hoat_dong" id="hoat_dong" class="form-control">
                <option value="1" {{ old('hoat_dong') == '1' ? 'selected' : '' }}>Có</option>
                <option value="0" {{ old('hoat_dong') == '0' ? 'selected' : '' }}>Không</option>
            </select>
            @error('hoat_dong')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.phuongthucthanhtoan.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection