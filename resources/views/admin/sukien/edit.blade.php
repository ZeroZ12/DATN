@extends('admin.layouts.app')

@section('title', 'Cập nhật Sự Kiện Mới')

@section('content')
    <div class="container mt-4"> {{-- Thêm margin-top để có khoảng cách với phần trên --}}
        <h2 class="mb-4 text-center">Cập nhật Sự Kiện Mới ✨</h2> {{-- Thêm icon và căn giữa --}}

        {{-- Hiển thị thông báo lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sukien.update', $suKien->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3"> {{-- Khoảng cách dưới cho mỗi nhóm input --}}
                <label for="ten_su_kien" class="form-label">Tên sự kiện <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_su_kien" name="ten_su_kien" value="{{ old('ten_su_kien', $suKien->ten_su_kien) }}" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên sự kiện.
                </div>
            </div>

            <div class="row mb-3"> {{-- Sử dụng grid system của Bootstrap cho ngày bắt đầu và kết thúc --}}
                <div class="col-md-6">
                    <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" value="{{ old('ngay_bat_dau', $suKien->ngay_bat_dau) ? \Carbon\Carbon::parse(old('ngay_bat_dau',$suKien->ngay_bat_dau))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày bắt đầu hợp lệ.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" value="{{ old('ngay_ket_thuc',$suKien->ngay_ket_thuc) ? \Carbon\Carbon::parse(old('ngay_ket_thuc',$suKien->ngay_ket_thuc))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày kết thúc sau ngày bắt đầu.
                    </div>
                </div>
            </div>

            <div class="mb-3">
            <label for="id_san_pham" class="form-label">Chọn sản phẩm</label>
            <select class="form-select select2-enable" id="id_san_pham" name="id_san_pham[]" multiple="multiple">
                @foreach($sanphams as $sanpham)
                    <option value="{{ $sanpham->id }}" {{ in_array($sanpham->id, old('id_san_pham', $suKien->sanPhams->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $sanpham->ten }} ({{ $sanpham->co_bien_the ? 'Có biến thể' : 'Không biến thể' }})
                    </option>
                @endforeach
            </select>
            @error('id_san_pham')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id_bien_the_san_pham" class="form-label">Chọn biến thể (nếu có)</label>
            <select class="form-select select2-enable" id="id_bien_the_san_pham" name="id_bien_the_san_pham[]" multiple="multiple">
                @foreach($bienThes as $bienThe)
                    <option value="{{ $bienThe->id }}" {{ in_array($bienThe->id, old('id_bien_the_san_pham', $suKien->bienTheSanPhams->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $bienThe->sanPham->ten }} - {{ $bienThe->ma_bien_the }}
                    </option>
                @endforeach
            </select>
            @error('id_bien_the_san_pham')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Giá sự kiện và Giới hạn số lượng</label>
            <div id="product_variant_prices">
                <p class="text-muted fst-italic">Vui lòng chọn sản phẩm hoặc biến thể để hiển thị các trường nhập giá và giới hạn số lượng.</p>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success btn-lg">💾 Cập nhật Sự Kiện</button>
            <a href="{{ route('admin.sukien.index') }}" class="btn btn-secondary btn-lg">↩️ Quay lại</a>
        </div>
    </form>
</div>
@endsection

@section('js-custom')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Khởi tạo Select2
        $('.select2-enable').select2({
            placeholder: "Chọn...",
            allowClear: true
        });

        const sanPhams = @json($sanphams->keyBy('id'));
        const bienThes = @json($bienThes->keyBy('id'));
        const productVariantPricesDiv = $('#product_variant_prices');

        // Dữ liệu từ sự kiện hiện tại
        const suKienData = {
            san_phams: @json($suKien->sanPhams->map(function($sanPham) {
                return [
                    'id' => $sanPham->id,
                    'gia_su_kien' => $sanPham->pivot->gia_su_kien,
                    'so_luong_gioi_han' => $sanPham->pivot->so_luong_gioi_han
                ];
            })->keyBy('id')),
            bien_thes: @json($suKien->bienTheSanPhams->map(function($bienThe) {
                return [
                    'id' => $bienThe->id,
                    'gia_su_kien' => $bienThe->pivot->gia_su_kien,
                    'so_luong_gioi_han' => $bienThe->pivot->so_luong_gioi_han
                ];
            })->keyBy('id'))
        };

        // Lấy dữ liệu old() hoặc dữ liệu hiện tại của sự kiện
        const oldInput = @json(old());

        function updatePriceQuantityFields() {
        productVariantPricesDiv.empty();

        const selectedSanPhams = $('#id_san_pham').val() || [];
        const selectedBienThes = $('#id_bien_the_san_pham').val() || [];

        if (selectedSanPhams.length === 0 && selectedBienThes.length === 0) {
            productVariantPricesDiv.append('<p class="text-muted fst-italic">Vui lòng chọn sản phẩm hoặc biến thể để hiển thị các trường nhập giá và giới hạn số lượng.</p>');
            return;
        }

        // Xử lý sản phẩm
            selectedSanPhams.forEach(function(sanPhamId) {
                const sanPham = sanPhams[sanPhamId];
                if (sanPham) {
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[sanPham.id] !== undefined
                        ? oldInput.gia_su_kien[sanPham.id]
                        : (suKienData.san_phams[sanPham.id] ? suKienData.san_phams[sanPham.id].gia_su_kien : '');
                    const oldSoLuongGioiHan = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[sanPham.id] !== undefined
                        ? oldInput.so_luong_gioi_han[sanPham.id]
                        : (suKienData.san_phams[sanPham.id] ? suKienData.san_phams[sanPham.id].so_luong_gioi_han : '');

                    productVariantPricesDiv.append(`
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title text-primary">${sanPham.ten}</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="gia_su_kien_${sanPham.id}" class="form-label">Giá sự kiện (${sanPham.ten}) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="gia_su_kien_${sanPham.id}"
                                                name="gia_su_kien[${sanPham.id}]" step="0.01" min="0" value="${oldGiaSuKien || ''}" required>
                                        <div class="form-text">Giá gốc: ${sanPham.gia}</div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="so_luong_gioi_han_${sanPham.id}" class="form-label">Giới hạn số lượng (${sanPham.ten})</label>
                                        <input type="number" class="form-control" id="so_luong_gioi_han_${sanPham.id}"
                                                name="so_luong_gioi_han[${sanPham.id}]" min="0" max="${sanPham.so_luong}" value="${oldSoLuongGioiHan || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${sanPham.so_luong}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

            // Xử lý biến thể
            selectedBienThes.forEach(function(bienTheId) {
                const bienThe = bienThes[bienTheId];
                if (bienThe) {
                    const key = 'bien_the_' + bienThe.id;
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[key] !== undefined
                        ? oldInput.gia_su_kien[key]
                        : (suKienData.bien_thes[bienThe.id] ? suKienData.bien_thes[bienThe.id].gia_su_kien : '');
                    const oldSoLuongGioiHan  = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[key] !== undefined
                        ? oldInput.so_luong_gioi_han[key]
                        : (suKienData.bien_thes[bienThe.id] ? suKienData.bien_thes[bienThe.id].so_luong_gioi_han : '');

                    productVariantPricesDiv.append(`
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title text-success">${bienThe.san_pham.ten} - ${bienThe.ma_bien_the}</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="gia_su_kien_bien_the_${bienThe.id}" class="form-label">Giá sự kiện (${bienThe.ma_bien_the}) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="gia_su_kien_bien_the_${bienThe.id}"
                                                name="gia_su_kien[bien_the_${bienThe.id}]" step="0.01" min="0" value="${oldGiaSuKien || ''}" required>
                                        <div class="form-text">Giá gốc: ${bienThe.gia}</div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="so_luong_gioi_han_bien_the_${bienThe.id}" class="form-label">Giới hạn số lượng (${bienThe.ma_bien_the})</label>
                                        <input type="number" class="form-control" id="so_luong_gioi_han_bien_the_${bienThe.id}"
                                                name="so_luong_gioi_han[bien_the_${bienThe.id}]" min="0" max="${bienThe.ton_kho}" value="${oldSoLuongGioiHan || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${bienThe.ton_kho}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        }

        // Cập nhật khi thay đổi lựa chọn
        $('#id_san_pham, #id_bien_the_san_pham').on('change', updatePriceQuantityFields);

        // Gọi hàm để hiển thị dữ liệu ban đầu
        updatePriceQuantityFields();

        // Validation của Bootstrap
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>
@endsection