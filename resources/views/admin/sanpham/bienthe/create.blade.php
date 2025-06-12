@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm biến thể sản phẩm: {{ $sanpham->ten }}</h1>

        <!-- Hiển thị thông báo nếu có -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Form tạo biến thể sản phẩm -->
        <form action="{{ route('admin.bienthe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_product" value="{{ $sanpham->id }}">

            <!-- Chọn RAM -->
            <div class="form-group">
                <label for="id_ram">Chọn RAM</label>
                <select name="id_ram" id="id_ram" class="form-control @error('id_ram') is-invalid @enderror">
                    <option value="">Chọn RAM</option>
                    @foreach ($ram as $r)
                        <option value="{{ $r->id }}" {{ old('id_ram') == $r->id ? 'selected' : '' }}>
                            {{ $r->dung_luong }}
                        </option>
                    @endforeach
                </select>
                @error('id_ram')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Chọn ổ cứng -->
            <div class="form-group">
                <label for="id_o_cung">Chọn ổ cứng</label>
                <select name="id_o_cung" id="id_o_cung" class="form-control @error('id_o_cung') is-invalid @enderror">
                    <option value="">Chọn ổ cứng</option>
                    @foreach ($ocung as $o)
                        <option value="{{ $o->id }}" {{ old('id_o_cung') == $o->id ? 'selected' : '' }}>
                            {{ $o->loai }} - {{ $o->dung_luong }}
                        </option>
                    @endforeach
                </select>
                @error('id_o_cung')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mã biến thể -->
            <div class="form-group">
                <label for="ma_bien_the">Mã biến thể</label>
                <input type="text" name="ma_bien_the" id="ma_bien_the"
                    class="form-control @error('ma_bien_the') is-invalid @enderror" value="{{ old('ma_bien_the') }}">
                @error('ma_bien_the')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Giá -->
            <div class="form-group">
                <label for="gia">Giá</label>
                <input type="number" name="gia" id="gia" class="form-control @error('gia') is-invalid @enderror"
                    value="{{ old('gia') }}">
                @error('gia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- gia so sanh -->
            <div class="form-group">
                <label for="gia_so_sanh">Giá so sánh</label>
                <input type="number" name="gia_so_sanh" id="gia_so_sanh"
                    class="form-control @error('gia_so_sanh') is-invalid @enderror" value="{{ old('gia_so_sanh') }}">
                @error('gia_so_sanh')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>




            <!-- Tồn kho -->
            <div class="form-group">
                <label for="ton_kho">Tồn kho</label>
                <input type="number" name="ton_kho" id="ton_kho"
                    class="form-control @error('ton_kho') is-invalid @enderror" value="{{ old('ton_kho') }}">
                @error('ton_kho')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Ảnh đại diện -->
            <div class="form-group">
                <label for="anh_dai_dien">Ảnh đại diện</label>
                <input type="file" name="anh_dai_dien" id="anh_dai_dien"
                    class="form-control @error('anh_dai_dien') is-invalid @enderror">
                @error('anh_dai_dien')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Lưu biến thể</button>
            <a href="{{ route('admin.bienthe.index', $sanpham->id) }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
