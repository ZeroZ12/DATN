@extends('admin.layouts.app')

@section('title', 'Thêm chip')

@section('content')
    <h2>Thêm chip mới</h2>

    <form action="{{ route('admin.chip.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">Tên chip <span class="text-danger">*</span></label>
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
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.chip.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection