@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa sản phẩm</h1>

        <!-- Hiển thị thông báo thành công khi cập nhật sản phẩm -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.sanpham.update', $sanpham->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Chỉ định phương thức PUT cho việc cập nhật -->

            <div class="form-group">
                <label for="ten">Tên sản phẩm</label>
                <input type="text" name="ten" id="ten" class="form-control"
                    value="{{ old('ten', $sanpham->ten) }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ma_san_pham">Mã sản phẩm</label>
                <input type="text" name="ma_san_pham" id="ma_san_pham" class="form-control"
                    value="{{ old('ma_san_pham', $sanpham->ma_san_pham) }}">
                @error('ma_san_pham')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mo_ta">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta', $sanpham->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_category">Danh mục</label>
                <select name="id_category" id="id_category" class="form-control">
                    <option value="">Chọn danh mục</option>
                    @foreach ($danhmucs as $danhmuc)
                        <option value="{{ $danhmuc->id }}"
                            {{ old('id_category', $sanpham->id_category) == $danhmuc->id ? 'selected' : '' }}>
                            {{ $danhmuc->ten }}</option>
                    @endforeach
                </select>
                @error('id_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_brand">Thương hiệu</label>
                <select name="id_brand" id="id_brand" class="form-control">
                    <option value="">Chọn thương hiệu</option>
                    @foreach ($thuonghieus as $thuonghieu)
                        <option value="{{ $thuonghieu->id }}"
                            {{ old('id_brand', $sanpham->id_brand) == $thuonghieu->id ? 'selected' : '' }}>
                            {{ $thuonghieu->ten }}</option>
                    @endforeach
                </select>
                @error('id_brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_chip">Chip</label>
                <select name="id_chip" id="id_chip" class="form-control">
                    <option value="">Chọn chip</option>
                    @foreach ($chips as $chip)
                        <option value="{{ $chip->id }}"
                            {{ old('id_chip', $sanpham->id_chip) == $chip->id ? 'selected' : '' }}>{{ $chip->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_chip')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_mainboard">Mainboard</label>
                <select name="id_mainboard" id="id_mainboard" class="form-control">
                    <option value="">Chọn mainboard</option>
                    @foreach ($mainboards as $mainboard)
                        <option value="{{ $mainboard->id }}"
                            {{ old('id_mainboard', $sanpham->id_mainboard) == $mainboard->id ? 'selected' : '' }}>
                            {{ $mainboard->ten }}</option>
                    @endforeach
                </select>
                @error('id_mainboard')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_gpu">GPU</label>
                <select name="id_gpu" id="id_gpu" class="form-control">
                    <option value="">Chọn GPU</option>
                    @foreach ($gpus as $gpu)
                        <option value="{{ $gpu->id }}"
                            {{ old('id_gpu', $sanpham->id_gpu) == $gpu->id ? 'selected' : '' }}>{{ $gpu->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_gpu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bao_hanh_thang">Bảo hành (tháng)</label>
                <input type="number" name="bao_hanh_thang" id="bao_hanh_thang" class="form-control"
                    value="{{ old('bao_hanh_thang', $sanpham->bao_hanh_thang) }}">
                @error('bao_hanh_thang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hoat_dong">Hoạt động</label>
                <input type="checkbox" name="hoat_dong" id="hoat_dong"
                    {{ old('hoat_dong', $sanpham->hoat_dong) ? 'checked' : '' }}>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="anh_dai_dien">Ảnh đại diện</label>
                <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control">
                @error('anh_dai_dien')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($sanpham->anh_dai_dien)
                    <small>Ảnh hiện tại: <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm"
                            style="max-width: 200px;"></small>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại</a>

            
        </form>
    </div>
@endsection
