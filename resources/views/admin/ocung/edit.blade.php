@extends('admin.layouts.app')

@section('title', 'Sửa ổ cứng')

@section('content')
    <h2>Sửa ổ cứng: {{ $oCung->dung_luong }} ({{ $oCung->loai }})</h2>

    <form action="{{ route('admin.ocung.update', $oCung->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="loai" class="form-label">Loại <span class="text-danger">*</span></label>
            <input type="text" name="loai" id="loai" class="form-control"
                value="{{ old('loai', $oCung->loai) }}">
            @error('loai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="dung_luong" class="form-label">Dung lượng <span class="text-danger">*</span></label>
            <input type="text" name="dung_luong" id="dung_luong" class="form-control"
                value="{{ old('dung_luong', $oCung->dung_luong) }}">
            @error('dung_luong')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô tả</label>
            <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta', $oCung->mo_ta) }}</textarea>
            @error('mo_ta')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.ocung.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection