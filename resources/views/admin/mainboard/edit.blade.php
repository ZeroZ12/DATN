@extends('admin.layouts.app')

@section('title', 'Sửa mainboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa mainboard: {{ $mainboard->ten }}</h2>

        <form action="{{ route('admin.mainboard.update', $mainboard->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ten" class="form-label">Tên mainboard <span class="text-danger">*</span></label>
                <input type="text" name="ten" id="ten" class="form-control"
                    value="{{ old('ten', $mainboard->ten) }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $mainboard->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.mainboard.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
