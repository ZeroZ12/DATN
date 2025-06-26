@extends('admin.layouts.app')

@section('title', 'Thêm chip')

@section('content')
    <div class="container">
        <h2 class="mb-4">🧠 Thêm chip mới</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.chip.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="ten" class="form-label fw-semibold">Tên chip <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control" value="{{ old('ten') }}">
                        @error('ten')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label for="gia" class="form-label fw-semibold">Giá <span class="text-danger">*</span></label>
                        <input type="number" name="gia" id="gia" class="form-control" value="{{ old('gia') }}">
                        @error('gia')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gia_sale" class="form-label fw-semibold">Giá sale </label>
                        <input type="number" name="gia_sale" id="gia_sale" class="form-control"
                            value="{{ old('gia_sale') }}">
                        @error('gia_sale')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control"
                            rows="6">{!! old('mo_ta', $chip->mo_ta ?? '') !!}</textarea>
                        @error('mo_ta')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.chip.index') }}" class="btn btn-secondary">← Quay lại</a>
                        <button type="submit" class="btn btn-success">💾 Lưu</button>
                    </div>
                </form>
            </div>
        </div>
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