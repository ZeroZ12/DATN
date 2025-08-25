@extends('admin.layouts.app')

@section('title', 'Thêm Sự Kiện Mới')

@section('content')
    <div class="container mt-4"> {{-- Thêm margin-top để có khoảng cách với phần trên --}}
        <h2 class="mb-4 text-center">Thêm Sự Kiện Mới ✨</h2> {{-- Thêm icon và căn giữa --}}

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

        <form action="{{ route('admin.sukien.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3"> {{-- Khoảng cách dưới cho mỗi nhóm input --}}
                <label for="ten_su_kien" class="form-label">Tên sự kiện <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_su_kien" name="ten_su_kien" value="{{ old('ten_su_kien') }}" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên sự kiện.
                </div>
            </div>

            <div class="row mb-3"> {{-- Sử dụng grid system của Bootstrap cho ngày bắt đầu và kết thúc --}}
                <div class="col-md-6">
                    <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" value="{{ old('ngay_bat_dau') ? \Carbon\Carbon::parse(old('ngay_bat_dau'))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày bắt đầu hợp lệ.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" value="{{ old('ngay_ket_thuc') ? \Carbon\Carbon::parse(old('ngay_ket_thuc'))->format('Y-m-d\TH:i') : '' }}" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày kết thúc sau ngày bắt đầu.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="id_san_pham" class="form-label">Chọn sản phẩm</label>
                {{-- Sử dụng Select2 để có giao diện đẹp và tìm kiếm cho select multiple --}}
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
                        <option value="{{ $bienThe->id }}" {{ in_array($bienThe->id, old('id_bien_the_san_pham', [])) ? 'selected' : '' }}>
                            {{ $bienThe->sanPham?->ten }} - {{ $bienThe->ma_bien_the }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Giá sự kiện và Giới hạn số lượng (chỉ điền cho các sản phẩm/biến thể đã chọn)</label>
                <div id="product_variant_prices">
                    {{-- Các input giá và số lượng sẽ được thêm bằng JavaScript --}}
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
{{-- Thêm thư viện Select2 cho các dropdown đẹp hơn và có chức năng tìm kiếm --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
<script>
    // Khởi tạo TinyMCE (nếu bạn có trường 'mo_ta' - trong mã bạn đưa ra không có, nhưng tôi giữ lại)
    tinymce.init({
        selector: '#mo_ta', // Đảm bảo có một textarea với id="mo_ta" nếu bạn muốn dùng TinyMCE
        height: 300,
        plugins: 'image link table lists code',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | image link table | code',
        menubar: false
    });

    $(document).ready(function() {
        // Khởi tạo Select2 cho các thẻ select
        $('.select2-enable').select2({
            placeholder: "Chọn...",
            allowClear: true // Cho phép xóa lựa chọn
        });

        const sanPhams = @json($sanphams->keyBy('id'));
        const bienThes = @json($bienThes->keyBy('id'));
        const productVariantPricesDiv = $('#product_variant_prices');

        // Lấy dữ liệu old() dưới dạng đối tượng JavaScript
        const oldInput = @json(old());

        function updatePriceQuantityFields() {
            productVariantPricesDiv.empty(); // Xóa các trường cũ

            const selectedSanPhams = $('#id_san_pham').val() || [];
            const selectedBienThes = $('#id_bien_the_san_pham').val() || [];

            if (selectedSanPhams.length === 0 && selectedBienThes.length === 0) {
                productVariantPricesDiv.append('<p class="text-muted fst-italic">Vui lòng chọn sản phẩm hoặc biến thể để hiển thị các trường nhập giá và giới hạn số lượng.</p>');
                return;
            }

            // Tạo trường cho các sản phẩm đã chọn
            selectedSanPhams.forEach(function(sanPhamId) {
                const sanPham = sanPhams[sanPhamId];
                if (sanPham) {
                    // Truy cập giá trị old từ đối tượng oldInput
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[sanPham.id] !== undefined ? oldInput.gia_su_kien[sanPham.id] : '';
                    const oldSoLuongGioiHan = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[sanPham.id] !== undefined ? oldInput.so_luong_gioi_han[sanPham.id] : '';

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
                                                name="so_luong_gioi_han[${sanPham.id}]" min="0" value="${oldSoLuongGioiHan || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${sanPham.so_luong}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

            // Tạo trường cho các biến thể đã chọn
            selectedBienThes.forEach(function(bienTheId) {
                const bienThe = bienThes[bienTheId];
                if (bienThe) {
                    // Truy cập giá trị old từ đối tượng oldInput
                    const oldGiaSuKien = oldInput.gia_su_kien && oldInput.gia_su_kien[`bien_the_${bienThe.id}`] !== undefined ? oldInput.gia_su_kien[`bien_the_${bienThe.id}`] : '';
                    const oldSoLuongGioiHan = oldInput.so_luong_gioi_han && oldInput.so_luong_gioi_han[`bien_the_${bienThe.id}`] !== undefined ? oldInput.so_luong_gioi_han[`bien_the_${bienThe.id}`] : '';

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
                                                name="so_luong_gioi_han[bien_the_${bienThe.id}]" min="0" value="${oldSoLuongGioiHan || ''}">
                                        <div class="form-text">Số lượng tồn kho: ${bienThe.ton_kho}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        }

        // Cập nhật các trường giá và số lượng khi lựa chọn sản phẩm/biến thể thay đổi
        $('#id_san_pham, #id_bien_the_san_pham').on('change', updatePriceQuantityFields);

        // Gọi hàm một lần khi tải trang để hiển thị các trường đã chọn từ `old()`
        updatePriceQuantityFields();

        // Thêm validation của Bootstrap
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    });
</script>
@endsection