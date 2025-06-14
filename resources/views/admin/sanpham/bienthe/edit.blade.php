@extends('admin.layouts.app')

@section('title', 'Sửa biến thể sản phẩm')

@section('content')
    <div class="container">
        <h1>Sửa biến thể của sản phẩm: {{ $sanpham->ten }}</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form action: Sử dụng route lồng ghép để cập nhật biến thể --}}
        <form action="{{ route('admin.sanpham.bienthe.update', [$sanpham->id, $bienthe->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Hidden input này không bắt buộc nếu dùng Model Binding đúng cách,
                 nhưng có thể hữu ích cho old() data và debugging. --}}
            <input type="hidden" name="id_product" value="{{ $sanpham->id }}">

            <div class="form-group mb-3">
                <label for="id_ram">RAM</label>
                <select name="id_ram" id="id_ram" class="form-control">
                    <option value="">Chọn RAM</option>
                    @foreach ($rams as $ram)
                        <option value="{{ $ram->id }}"
                            {{ old('id_ram', $bienthe->id_ram) == $ram->id ? 'selected' : '' }}>
                            {{ $ram->dung_luong }}
                        </option>
                    @endforeach
                </select>
                @error('id_ram')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_o_cung">Ổ Cứng</label>
                <select name="id_o_cung" id="id_o_cung" class="form-control">
                    <option value="">Chọn Ổ Cứng</option>
                    @foreach ($ocungs as $oc)
                        <option value="{{ $oc->id }}"
                            {{ old('id_o_cung', $bienthe->id_o_cung) == $oc->id ? 'selected' : '' }}>
                            {{ $oc->dung_luong }}
                        </option>
                    @endforeach
                </select>
                @error('id_o_cung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="ma_bien_the">Mã biến thể</label>
                {{-- Mã biến thể thường không được sửa trực tiếp --}}
                <input type="text" name="ma_bien_the" id="ma_bien_the" class="form-control"
                    value="{{ old('ma_bien_the', $bienthe->ma_bien_the) }}" readonly>
                <small class="form-text text-muted">Mã biến thể được tạo tự động và không thể chỉnh sửa.</small>
                @error('ma_bien_the')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="gia">Giá</label>
                <input type="number" step="0.01" name="gia" id="gia" class="form-control"
                    value="{{ old('gia', $bienthe->gia) }}">
                @error('gia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="gia_so_sanh">Giá so sánh (tùy chọn)</label>
                <input type="number" step="0.01" name="gia_so_sanh" id="gia_so_sanh" class="form-control"
                    value="{{ old('gia_so_sanh', $bienthe->gia_so_sanh) }}">
                @error('gia_so_sanh')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="ton_kho">Tồn kho</label>
                <input type="number" name="ton_kho" id="ton_kho" class="form-control"
                    value="{{ old('ton_kho', $bienthe->ton_kho) }}">
                @error('ton_kho')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- THÊM CHECKBOX HOẠT ĐỘNG --}}
            <div class="form-group mb-3">
                <label for="hoat_dong">Hoạt động</label>
                <input type="checkbox" name="hoat_dong" id="hoat_dong"
                    {{ old('hoat_dong', $bienthe->hoat_dong) ? 'checked' : '' }}>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="anh_dai_dien">Ảnh đại diện biến thể (tùy chọn)</label>
                <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control">
                @error('anh_dai_dien')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($bienthe->anh_dai_dien)
                    <small>Ảnh hiện tại: <img src="{{ asset('storage/' . $bienthe->anh_dai_dien) }}" alt="Ảnh biến thể"
                            style="max-width: 150px; display: block; margin-top: 5px;"></small>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật biến thể</button>
            {{-- Nút quay lại: Sử dụng route lồng ghép --}}
            <a href="{{ route('admin.sanpham.bienthe.index', $sanpham->id) }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
