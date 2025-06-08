@extends('admin.layouts.app')

@section('title', 'Sửa GPU')

@section('content')
    <h2>Sửa GPU: {{ $gpu->ten }}</h2>

    <form action="{{ route('admin.gpu.update', $gpu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ten" class="form-label">Tên GPU <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control"
                value="{{ old('ten', $gpu->ten) }}">
            @error('ten')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô tả</label>
            <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta', $gpu->mo_ta) }}</textarea>
            @error('mo_ta')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.gpu.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection