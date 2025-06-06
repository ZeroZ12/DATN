@extends('admin.layouts.app')

@section('title', 'Sửa danh mục')

@section('content')
    <h2>Sửa danh mục: {{ $danhmuc->ten }}</h2>



    <form action="{{ route('admin.danhmuc.update', $danhmuc->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ten" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control" required
                value="{{ old('ten', $danhmuc->ten) }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
