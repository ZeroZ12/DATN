@extends('admin.layouts.app')

@section('title', 'Sửa danh mục')

@section('content')
    <div class="container">
        <h2 class="mb-4">Sửa danh mục: {{ $danhmuc->ten }}</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.danhmuc.update', $danhmuc->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="ten" class="form-control" required
                            value="{{ old('ten', $danhmuc->ten) }}">
                        @error('ten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                        <input type="file" name="hinh_anh" id="hinh_anh" class="form-control"
                            accept="image/*">
                
                        @if($danhmuc->hinh_anh)
                          
                            <img src="{{ asset('storage/' . $danhmuc->hinh_anh) }}" alt="{{ $danhmuc->ten }}" class="mt-2 img-thumbnail" style="max-width: 200px;">
                        @endif
                        @error('hinh_anh')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">← Hủy</a>
                        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
