@extends('admin.layouts.app')

@section('title', 'Thêm thương hiệu')

@section('content')
    <h2>Thêm thương hiệu mới</h2>

    <form action="{{ route('admin.thuonghieu.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">Tên thương hiệu <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control" value="{{ old('ten') }}">
            @error('ten')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection