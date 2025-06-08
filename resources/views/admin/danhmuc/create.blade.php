@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('content')
   <div class="page-body">

    <h2 class="mt-4">Thêm danh mục mới</h2>



    <form action="{{ route('admin.danhmuc.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
            <input type="text" name="ten" id="ten" class="form-control" required value="{{ old('ten') }}">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
    </div>

@endsection
