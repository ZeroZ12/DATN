@extends('admin.layouts.app')

@section('title', 'Sửa phương thức thanh toán')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa phương thức thanh toán: {{ $phuongThucThanhToan->ten }}</h2>

        <form action="{{ route('admin.phuongthucthanhtoan.update', $phuongThucThanhToan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ten" class="form-label">Tên phương thức <span class="text-danger">*</span></label>
                <input type="text" name="ten" id="ten" class="form-control"
                    value="{{ old('ten', $phuongThucThanhToan->ten) }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $phuongThucThanhToan->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hoat_dong" class="form-label">Hoạt động <span class="text-danger">*</span></label>
                <select name="hoat_dong" id="hoat_dong" class="form-select">
                    <option value="1" {{ old('hoat_dong', $phuongThucThanhToan->hoat_dong) ? 'selected' : '' }}>Có
                    </option>
                    <option value="0" {{ !old('hoat_dong', $phuongThucThanhToan->hoat_dong) ? 'selected' : '' }}>Không
                    </option>
                </select>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.phuongthucthanhtoan.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
