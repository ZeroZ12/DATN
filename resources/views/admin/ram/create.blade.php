@extends('admin.layouts.app')

@section('title', 'Thêm RAM')

@section('content')
    <h2>Thêm RAM mới</h2>

    <form action="{{ route('admin.ram.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dung_luong" class="form-label">Dung lượng <span class="text-danger">*</span></label>
            <input type="text" name="dung_luong" id="dung_luong" class="form-control" value="{{ old('dung_luong') }}">
            @error('dung_luong')
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
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.ram.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection