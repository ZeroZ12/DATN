@extends('admin.layouts.app')

@section('title', 'Thêm Sự Kiện Mới')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Thêm Sự Kiện Mới ✨</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sukien.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label for="ten_su_kien" class="form-label">Tên sự kiện <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_su_kien" name="ten_su_kien" value="{{ old('ten_su_kien') }}" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên sự kiện.
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau"
                           value="{{ old('ngay_bat_dau') ? \Carbon\Carbon::parse(old('ngay_bat_dau'))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày bắt đầu hợp lệ.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc"
                           value="{{ old('ngay_ket_thuc') ? \Carbon\Carbon::parse(old('ngay_ket_thuc'))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày kết thúc sau ngày bắt đầu.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="id_san_pham" class="form-label">Chọn sản phẩm</label>
                <select class="form-select select2-enable" id="id_san_pham" name="id_san_pham[]" multiple="multiple">
                    @foreach($sanphams as $sanpham)
                        <option value="{{ $sanpham->id }}" {{ in_array($sanpham->id, old('id_san_pham', [])) ? 'selected' : '' }}>
                            {{ $sanpham->ten }} ({{ $sanpham->co_bien_the ? 'Có biến thể' : 'Không biến thể' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_bien_the_san_pham" class="form-label">Chọn biến thể (nếu có)</label>
                <select class="form-select select2-enable" id="id_bien_the_san_pham" name="id_bien_the_san_pham[]" multiple="multiple">
                    @foreach($bienThes as $bienThe)
                        {{-- Sử dụng optional để tránh lỗi nếu sanPham là null --}}
                        <option value="{{ $bienThe->id }}" {{ in_array($bienThe->id, old('id_bien_the_san_pham', [])) ? 'selected' : '' }}
                            data-parent-id="{{ $bienThe->san_pham_id ?? ($bienThe->sanPham->id ?? '') }}">
                            {{ optional($bienThe->sanPham)->ten ?? ('#SP' . ($bienThe->san_pham_id ?? '')) }} - {{ $bienThe->ma_bien_the }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Giá sự kiện và Giới hạn số lượng (chỉ điền cho các sản phẩm/biến thể đã chọn)</label>
                <div id="product_variant_prices">
                    <p class="text-muted fst-italic">Vui lòng chọn sản phẩm hoặc biến thể để hiển thị các trường nhập giá và giới hạn số lượng.</p>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success btn-lg">💾 Lưu Sự Kiện</button>
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
            allowClear: true,
            width: '100%'
        });

        // Dữ liệu từ server
        const sanPhams = @json($sanphams->keyBy('id'));
        const bienThes = @json($bienThes->keyBy('id'));
        const productVariantPricesDiv = $('#product_variant_prices');

        // old() dữ liệu
        const oldInput = @json(old());

        // Build map variantsByProduct: { productId: [variant,...] }
        const variantsByProduct = {};
        Object.keys(bienThes || {}).forEach(k => {
            const v = bienThes[k];
            // xác định parent id an toàn (nhiều cấu trúc có thể xuất ra)
            const parentId = v.san_pham_id ?? v.san_pham?.id ?? v.sanPham?.id ?? null;
            if (!parentId) return;
            if (!variantsByProduct[parentId]) variantsByProduct[parentId] = [];
            variantsByProduct[parentId].push(v);
        });

        // Hàm cập nhật trạng thái option biến thể theo products được chọn
        function updateVariantOptions() {
            const selectedProducts = $('#id_san_pham').val() || [];
            const allowedSet = new Set();
            selectedProducts.forEach(pid => {
                (variantsByProduct[pid] || []).forEach(v => allowedSet.add(String(v.id)));
            });

            $('#id_bien_the_san_pham option').each(function() {
                const val = $(this).val();
                if (allowedSet.size === 0) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', allowedSet.has(val) ? false : true);
                }
            });

            // Loại bỏ các variant đã chọn nhưng giờ bị disable
            const currentVariants = $('#id_bien_the_san_pham').val() || [];
            const newSelected = currentVariants.filter(v => {
                const opt = $('#id_bien_the_san_pham option[value="'+v+'"]');
                return opt.length && !opt.prop('disabled');
            });
            $('#id_bien_the_san_pham').val(newSelected).trigger('change.select2');

            // Refresh select2
            $('#id_bien_the_san_pham').trigger('change.select2');
        }

        // Hàm render các trường giá và số lượng (an toàn khi dữ liệu thiếu)
        function updatePriceQuantityFields() {
            productVariantPricesDiv.empty();

            const selectedSanPhams = $('#id_san_pham').val() || [];
            const selectedBienThes = $('#id_bien_the_san_pham').val() || [];

            if (selectedSanPhams.length === 0 && selectedBienThes.length === 0) {
                productVariantPricesDiv.append('<p class="text-muted fst-italic">Vui lòng chọn sản phẩm hoặc biến thể để hiển thị các trường nhập giá và giới hạn số lượng.</p>');
                return;
            }

            // Sản phẩm
            selectedSanPhams.forEach(function(sanPhamId) {
                const sanPham = sanPhams[sanPhamId];
                if (sanPham) {
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[sanPham.id] !== undefined ? oldInput.gia_su_kien[sanPham.id] : '';
                    const oldSoLuongGioiHan = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[sanPham.id] !== undefined ? oldInput.so_luong_gioi_han[sanPham.id] : '';

                    productVariantPricesDiv.append(`
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title text-primary">${sanPham.ten}</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Giá sự kiện (${sanPham.ten}) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="gia_su_kien[${sanPham.id}]" step="0.01" min="0" value="${oldGiaSuKien || ''}" required>
                                        <div class="form-text">Giá gốc: ${sanPham.gia ?? 0}</div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Giới hạn số lượng (${sanPham.ten})</label>
                                        <input type="number" class="form-control" name="so_luong_gioi_han[${sanPham.id}]" min="0" value="${oldSoLuongGioiHan || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${sanPham.so_luong ?? 0}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

            // Biến thể
            selectedBienThes.forEach(function(bienTheId) {
                const bienThe = bienThes[bienTheId];
                if (bienThe) {
                    // Lấy tên product an toàn
                    const productName = bienThe?.san_pham?.ten ?? bienThe?.sanPham?.ten ?? bienThe?.ten ?? bienThe?.ma_bien_the ?? 'Sản phẩm';
                    const oldKey = `bien_the_${bienThe.id}`;
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[oldKey] !== undefined ? oldInput.gia_su_kien[oldKey] : '';
                    const oldSoLuong = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[oldKey] !== undefined ? oldInput.so_luong_gioi_han[oldKey] : '';

                    productVariantPricesDiv.append(`
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title text-success">${productName} - ${bienThe.ma_bien_the}</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Giá sự kiện (${bienThe.ma_bien_the}) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="gia_su_kien[bien_the_${bienThe.id}]" step="0.01" min="0" value="${oldGiaSuKien || ''}" required>
                                        <div class="form-text">Giá gốc: ${bienThe.gia ?? 0}</div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Giới hạn số lượng (${bienThe.ma_bien_the})</label>
                                        <input type="number" class="form-control" name="so_luong_gioi_han[bien_the_${bienThe.id}]" min="0" value="${oldSoLuong || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${bienThe.ton_kho ?? 0}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        }

        // Khi product change
        $('#id_san_pham').on('change', function() {
            updateVariantOptions();
            updatePriceQuantityFields();
        });

        // Khi user chọn một variant: auto-select product cha (UX)
        $('#id_bien_the_san_pham').on('select2:select', function(e) {
            const variantId = e.params?.data?.id;
            const v = bienThes[variantId];
            const parentId = v?.san_pham_id ?? v?.san_pham?.id ?? v?.sanPham?.id ?? null;
            if (parentId) {
                let currentProducts = $('#id_san_pham').val() || [];
                currentProducts = currentProducts.map(String);
                if (!currentProducts.includes(String(parentId))) {
                    currentProducts.push(String(parentId));
                    $('#id_san_pham').val(currentProducts).trigger('change');
                }
            }
        });

        // Khi variant change (bỏ chọn)
        $('#id_bien_the_san_pham').on('change', function() {
            updatePriceQuantityFields();
        });

        // Ban đầu gọi
        updateVariantOptions();
        updatePriceQuantityFields();

        // Bootstrap validation
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