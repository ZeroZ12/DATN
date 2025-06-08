@extends('admin.layouts.app')

@section('content')
    <h4>Thêm sản phẩm mới</h4>

    <form action="{{ route('admin.sanpham.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="ten">Tên sản phẩm</label>
            <input type="text" name="ten" class="form-control" value="{{ old('ten') }}" required>
        </div>

        <div class="mb-3">
            <label for="ma_san_pham">Mã sản phẩm</label>
            <input type="text" name="ma_san_pham" class="form-control" value="{{ old('ma_san_pham') }}" required>
        </div>

        <div class="mb-3">
            <label for="anh_dai_dien">Ảnh đại diện</label>
            <input type="file" name="anh_dai_dien" class="form-control">
        </div>

        <div class="mb-3">
            <label for="mo_ta">Mô tả</label>
            <textarea name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_chip">Chip</label>
                <select name="id_chip" class="form-select" required>
                    @foreach($chips as $chip)
                        <option value="{{ $chip->id }}" {{ old('id_chip') == $chip->id ? 'selected' : '' }}>{{ $chip->ten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_mainboard">Mainboard</label>
                <select name="id_mainboard" class="form-select" required>
                    @foreach($mainboards as $mainboard)
                        <option value="{{ $mainboard->id }}" {{ old('id_mainboard') == $mainboard->id ? 'selected' : '' }}>{{ $mainboard->ten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_gpu">GPU</label>
                <select name="id_gpu" class="form-select" required>
                    @foreach($gpus as $gpu)
                        <option value="{{ $gpu->id }}" {{ old('id_gpu') == $gpu->id ? 'selected' : '' }}>{{ $gpu->ten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_category">Danh mục</label>
                <select name="id_category" class="form-select" required>
                    @foreach($danhmucs as $danhMuc)
                        <option value="{{ $danhMuc->id }}" {{ old('id_category') == $danhMuc->id ? 'selected' : '' }}>{{ $danhMuc->ten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_brand">Thương hiệu</label>
                <select name="id_brand" class="form-select" required>
                    @foreach($thuonghieus as $thuongHieu)
                        <option value="{{ $thuongHieu->id }}" {{ old('id_brand') == $thuongHieu->id ? 'selected' : '' }}>{{ $thuongHieu->ten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="bao_hanh_thang">Bảo hành (tháng)</label>
                <input type="number" name="bao_hanh_thang" class="form-control" value="{{ old('bao_hanh_thang', 12) }}" required>
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="hoat_dong" value="1"
                {{ old('hoat_dong', true) ? 'checked' : '' }}>
            <label class="form-check-label">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
