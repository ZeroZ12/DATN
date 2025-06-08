@extends('admin.layouts.app')

@section('title', 'Sửa thương hiệu')

@section('content')
    <h2>Sửa thương hiệu: {{ $thuongHieu->ten }}</h2>

    <form action="{{ route('admin.thuonghieu.update', $thuongHieu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ten" class="form-label">Tên thương hiệu <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control"
                value="{{ old('ten', $thuongHieu->ten) }}">
            @error('ten')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection