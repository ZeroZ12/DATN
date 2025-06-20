@extends('admin.layouts.app')

@section('title', 'Sửa RAM')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa RAM: {{ $ram->dung_luong }}</h2>

        <form action="{{ route('admin.ram.update', $ram->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="dung_luong" class="form-label">Dung lượng <span class="text-danger">*</span></label>
                <input type="text" name="dung_luong" id="dung_luong" class="form-control"
                    value="{{ old('dung_luong', $ram->dung_luong) }}">
                @error('dung_luong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gia" class="form-label fw-semibold">Giá <span class="text-danger">*</span></label>
                <input type="number" name="gia" id="gia" class="form-control" value="{{ old('gia') }}">
                @error('gia')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gia_sale" class="form-label fw-semibold">Giá sale </label>
                <input type="number" name="gia_sale" id="gia_sale" class="form-control" value="{{ old('gia_sale') }}">
                @error('gia_sale')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $ram->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.ram.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection

@section('js-custom')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
<script>
        tinymce.init({
            selector: '#mo_ta',
            height: 300,
            plugins: 'image link table lists code',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | image link table | code',
            menubar: false
        });
    </script>
@endsection