@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa sản phẩm</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form action="{{ route('admin.sanpham.update', $sanpham->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="fw-bold">Loại sản phẩm:</label>
                <div>
                    <label>
                        <input type="radio" name="co_bien_the" value="1" {{ old('co_bien_the', $sanpham->co_bien_the) == 1 ? 'checked' : '' }}>
                        Có biến thể
                    </label>
                    <label class="ms-3">
                        <input type="radio" name="co_bien_the" value="0" {{ old('co_bien_the', $sanpham->co_bien_the) == 0 ? 'checked' : '' }}>
                        Không có biến thể
                    </label>
                </div>
            </div>

            <div id="simple-product-fields" style="display: none;">
                <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="number" name="gia" class="form-control" step="0.01" min="0" value="{{ old('gia', $sanpham->gia) }}">
                    @error('gia') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="gia_so_sanh">Giá so sánh</label>
                    <input type="number" name="gia_so_sanh" class="form-control" step="0.01" min="0" value="{{ old('gia_so_sanh', $sanpham->gia_so_sanh) }}">
                    @error('gia_so_sanh') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="so_luong">Số lượng</label>
                    <input type="number" name="so_luong" class="form-control" min="0" value="{{ old('so_luong', $sanpham->so_luong) }}">
                    @error('so_luong') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label>Tên sản phẩm</label>
                <input type="text" name="ten" class="form-control" value="{{ old('ten', $sanpham->ten) }}">
                @error('ten')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Mã sản phẩm</label>
                <input type="text" class="form-control" value="{{ old('ma_san_pham', $sanpham->ma_san_pham) }}" disabled>
                <input type="hidden" name="ma_san_pham" value="{{ old('ma_san_pham', $sanpham->ma_san_pham) }}">
                @error('ma_san_pham')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control"
                    rows="6">{{ old('mo_ta', $sanpham->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="mo_ta" class="form-control">{{ old('mo_ta', $sanpham->mo_ta) }}</textarea>
            </div> --}}

            <div class="row mb-3">
                <div class="col">
                    <label>Chip</label>
                    <select name="id_chip" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($chips as $chip)
                            <option value="{{ $chip->id }}" {{ $sanpham->id_chip == $chip->id ? 'selected' : '' }}>{{ $chip->ten }} ({{ number_format($chip->gia) }}đ{{ $chip->gia_sale ? ' - Sale: ' . number_format($chip->gia_sale) . 'đ' : '' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Mainboard</label>
                    <select name="id_mainboard" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($mainboards as $mb)
                            <option value="{{ $mb->id }}" {{ $sanpham->id_mainboard == $mb->id ? 'selected' : '' }}>{{ $mb->ten }} ({{ number_format($mb->gia) }}đ{{ $mb->gia_sale ? ' - Sale: ' . number_format($mb->gia_sale) . 'đ' : '' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>GPU</label>
                    <select name="id_gpu" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($gpus as $gpu)
                            <option value="{{ $gpu->id }}" {{ $sanpham->id_gpu == $gpu->id ? 'selected' : '' }}>{{ $gpu->ten }} ({{ number_format($gpu->gia) }}đ{{ $gpu->gia_sale ? ' - Sale: ' . number_format($gpu->gia_sale) . 'đ' : '' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Tản Nhiệt</label>
                    <select name="id_tannhiet" class="form-select">
                        @foreach ($tannhiets as $tannhiet)
                            <option value="{{ $tannhiet->id }}" data-price="{{ $tannhiet->gia }}" data-sale="{{ $tannhiet->gia_sale }}" {{ $sanpham->id_tannhiet == $tannhiet->id ? 'selected' : '' }}>
                                {{ $tannhiet->ten }}
                                ({{ number_format($tannhiet->gia) }}đ{{ $tannhiet->gia_sale ? ' - Sale: ' . number_format($tannhiet->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Nguồn</label>
                    <select name="id_nguon" class="form-select">
                        @foreach ($nguons as $nguon)
                            <option value="{{ $nguon->id }}" data-price="{{ $nguon->gia }}" data-sale="{{ $nguon->gia_sale }}" {{ $sanpham->id_nguon == $nguon->id ? 'selected' : '' }}>
                                {{ $nguon->ten }}
                                ({{ number_format($nguon->gia) }}đ{{ $nguon->gia_sale ? ' - Sale: ' . number_format($nguon->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Case</label>
                    <select name="id_case" class="form-select">
                        @foreach ($cases as $case)
                            <option value="{{ $case->id }}" data-price="{{ $case->gia }}" data-sale="{{ $case->gia_sale }}" {{ $sanpham->id_case == $case->id ? 'selected' : '' }}>
                                {{ $case->ten }}
                                ({{ number_format($case->gia) }}đ{{ $case->gia_sale ? ' - Sale: ' . number_format($case->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Danh mục</label>
                    <select name="id_category" class="form-select">
                        @foreach ($danhmucs as $dm)
                            <option value="{{ $dm->id }}" {{ $sanpham->id_category == $dm->id ? 'selected' : '' }}>
                                {{ $dm->ten }}

                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Thương hiệu</label>
                    <select name="id_brand" class="form-select">
                        @foreach ($thuonghieus as $th)
                            <option value="{{ $th->id }}" {{ $sanpham->id_brand == $th->id ? 'selected' : '' }}>
                                {{ $th->ten }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Bảo hành (tháng)</label>
                    <input type="number" name="bao_hanh_thang" class="form-control"
                        value="{{ old('bao_hanh_thang', $sanpham->bao_hanh_thang) }}">
                </div>
            </div>

            <h5>Ảnh đại diện</h5>
            @if ($sanpham->anh_dai_dien)
                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" width="150" class="mb-2">
            @endif
            <input type="file" name="anh_dai_dien" class="form-control mb-3">

            <h5>Ảnh phụ</h5>
            <div class="mb-2">
                @foreach ($sanpham->anhPhu as $anh)
                    <div class="d-inline-block position-relative me-2">
                        <img src="{{ asset('storage/' . $anh->duong_dan) }}" width="100">
                        <input type="checkbox" name="xoa_anh_phu[]" value="{{ $anh->id }}"> Xóa
                    </div>
                @endforeach
            </div>
            <input type="file" name="anh_phu[]" class="form-control mb-4" multiple>

            <div class="form-group mb-3">
                <label for="hoat_dong">Hoạt động</label>
                <input type="checkbox" name="hoat_dong" id="hoat_dong" {{ old('hoat_dong', $sanpham->hoat_dong) ? 'checked' : '' }}>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2 bien-the-section">
                <h4 class="mb-0">Biến thể</h4>
                <div>
                    <button type="button" id="add-multiple-variants" class="btn btn-secondary btn-sm me-2">+ Thêm nhiều biến thể</button>
                    <button type="button" id="add-variant" class="btn btn-primary btn-sm">+ Thêm biến thể</button>
                </div>
            </div>

            {{-- Giá chung và tổng giá linh kiện --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    {{-- <label>Giá áp dụng cho tất cả</label>
                    <input type="number" step="0.01" id="global-price" class="form-control" value="0"> --}}
                    <label>Tổng giá PC: <span id="tong-gia-linh-kien" class="fw-bold text-danger">0</span> đ</label>
                </div>
                {{-- <div class="col-md-4">
                    <label>Giá so sánh áp dụng</label>
                    <input type="number" step="0.01" id="global-price-compare" class="form-control">
                </div> --}}
            </div>

            <div id="bulk-variant-form" class="card card-body mb-3" style="display: none;">
                <h5>Chọn RAM và Ổ cứng để tạo biến thể</h5>
                <div class="row">
                    <div class="col">
                        <label>RAM</label>
                        @foreach ($rams as $ram)
                            <div class="form-check">
                                <input class="form-check-input ram-checkbox" type="checkbox" value="{{ $ram->id }}"
                                    id="ram{{ $ram->id }}">
                                <label class="form-check-label" for="ram{{ $ram->id }}">{{ $ram->dung_luong }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <label>Ổ cứng</label>
                        @foreach ($o_cungs as $oc)
                            <div class="form-check">
                                <input class="form-check-input oc-checkbox" type="checkbox" value="{{ $oc->id }}"
                                    id="oc{{ $oc->id }}">
                                <label class="form-check-label" for="oc{{ $oc->id }}">{{ $oc->loai }} -
                                    {{ $oc->dung_luong }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" id="generate-multiple-variants" class="btn btn-success mt-3">Tạo các biến
                    thể</button>
            </div>

            <div id="variant-container" class="bien-the-section">
                @foreach ($sanpham->bienTheSanPhams as $i => $variant)
                    <div class="border p-3 mb-2 variant-item">
                        <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $variant->id }}">
                        <div class="row">
                            <div class="col">
                                <label>RAM</label>
                                <select name="variants[{{ $i }}][ram_id]" class="form-select">
                                    @foreach ($rams as $ram)
                                        <option value="{{ $ram->id }}" {{ $variant->id_ram == $ram->id ? 'selected' : '' }}>
                                            {{ $ram->dung_luong }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Ổ cứng</label>
                                <select name="variants[{{ $i }}][o_cung_id]" class="form-select">
                                    @foreach ($o_cungs as $oc)
                                        <option value="{{ $oc->id }}" {{ $variant->id_o_cung == $oc->id ? 'selected' : '' }}>
                                            {{ $oc->loai }} -
                                            {{ $oc->dung_luong }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col"><label>Giá</label><input type="number" name="variants[{{ $i }}][gia]"
                                    class="form-control" value="{{ $variant->gia }}">
                            </div>
                            <div class="col"><label>Giá so sánh</label><input type="number"
                                    name="variants[{{ $i }}][gia_so_sanh]" class="form-control"
                                    value="{{ $variant->gia_so_sanh }}">
                            </div>
                            <div class="col"><label>Tồn kho</label><input type="number" name="variants[{{ $i }}][ton_kho]"
                                    class="form-control" value="{{ $variant->ton_kho }}">
                            </div>
                            <div class="col"><label>Mã biến thể</label><input type="text" class="form-control"
                                    value="{{ $variant->ma_bien_the }}" disabled></div>
                            <div class="col-auto d-flex align-items-end"><button type="button"
                                    class="btn btn-danger btn-sm remove-variant">Xóa</button></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Validate form trước khi submit
        document.querySelector('form').addEventListener('submit', function(e) {
            let hasError = false;
            const errorMessages = [];

            // Validate tên sản phẩm
            const ten = document.querySelector('input[name="ten"]').value;
            if (!ten) {
                hasError = true;
                errorMessages.push('Tên sản phẩm là bắt buộc');
            }

            // Validate mô tả
            const moTa = tinymce.get('mo_ta').getContent();
            if (!moTa) {
                hasError = true;
                errorMessages.push('Mô tả là bắt buộc');
            }

            // Validate biến thể
            const variants = document.querySelectorAll('.variant-item');
            if (variants.length === 0) {
                hasError = true;
                errorMessages.push('Phải có ít nhất một biến thể');
            }

            variants.forEach((variant, index) => {
                const gia = variant.querySelector('input[name^="variants"][name$="[gia]"]').value;
                const giaSoSanh = variant.querySelector('input[name^="variants"][name$="[gia_so_sanh]"]').value;
                const tonKho = variant.querySelector('input[name^="variants"][name$="[ton_kho]"]').value;

                if (!gia || gia < 0) {
                    hasError = true;
                    errorMessages.push(`Biến thể ${index + 1}: Giá không hợp lệ`);
                }

                if (giaSoSanh && (giaSoSanh < 0 || parseFloat(giaSoSanh) > parseFloat(gia))) {
                    hasError = true;
                    errorMessages.push(`Biến thể ${index + 1}: Giá so sánh không hợp lệ`);
                }

                if (!tonKho || tonKho < 0) {
                    hasError = true;
                    errorMessages.push(`Biến thể ${index + 1}: Tồn kho không hợp lệ`);
                }
            });

            if (hasError) {
                e.preventDefault();
                alert('Vui lòng kiểm tra lại form:\n' + errorMessages.join('\n'));
            }
        });

        // Format số cho các trường giá và tồn kho
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
            });
        });

        function getSelectedOptionPrice(selector) {
            const select = document.querySelector(selector);
            if (!select) return 0;
            const selected = select.options[select.selectedIndex];
            return selected && selected.dataset.price ? parseFloat(selected.dataset.price) : 0;
        }

        function tinhTongGiaLinhKien() {
            let tong = 0;
            tong += getSelectedOptionPrice('select[name="id_chip"]');
            tong += getSelectedOptionPrice('select[name="id_mainboard"]');
            tong += getSelectedOptionPrice('select[name="id_gpu"]');
            tong += getSelectedOptionPrice('select[name="id_case"]');
            tong += getSelectedOptionPrice('select[name="id_tannhiet"]');
            tong += getSelectedOptionPrice('select[name="id_nguon"]');
            // Nếu có thêm các select khác, bổ sung vào đây
            document.getElementById('tong-gia-linh-kien').innerText = tong.toLocaleString();
        }

        // Gắn sự kiện cho tất cả select
        document.querySelectorAll('select').forEach(el => {
            el.addEventListener('change', tinhTongGiaLinhKien);
        });

        // Gọi lần đầu khi load trang
        tinhTongGiaLinhKien();


        let variantIndex = {{ $sanpham->bienTheSanPhams->count() }};

        document.getElementById('add-variant').addEventListener('click', function () {
            const html = `
            <div class="border p-3 mb-2 variant-item">
                <div class="row">
                    <div class="col">
                        <label>RAM</label>
                        <select name="variants[${variantIndex}][ram_id]" class="form-select">
                            @foreach ($rams as $ram)
                                <option value="{{ $ram->id }}">{{ $ram->dung_luong }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Ổ cứng</label>
                        <select name="variants[${variantIndex}][o_cung_id]" class="form-select">
                            @foreach ($o_cungs as $oc)
                                <option value="{{ $oc->id }}">{{ $oc->loai }} - {{ $oc->dung_luong }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Giá</label>
                        <input type="number" name="variants[${variantIndex}][gia]" class="form-control">
                    </div>
                    <div class="col">
                        <label>Giá so sánh</label>
                        <input type="number" name="variants[${variantIndex}][gia_so_sanh]" class="form-control">
                    </div>
                    <div class="col">
                        <label>Tồn kho</label>
                        <input type="number" name="variants[${variantIndex}][ton_kho]" class="form-control">
                    </div>
                    <div class="col-auto d-flex align-items-end"><button type="button" class="btn btn-danger btn-sm remove-variant">Xóa</button></div>
                </div>
            </div>`;
            document.getElementById('variant-container').insertAdjacentHTML('beforeend', html);
            variantIndex++;
        });

        document.getElementById('add-multiple-variants').addEventListener('click', function () {
            const form = document.getElementById('bulk-variant-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

        document.getElementById('generate-multiple-variants').addEventListener('click', function () {
            const rams = document.querySelectorAll('.ram-checkbox:checked');
            const ocs = document.querySelectorAll('.oc-checkbox:checked');
            const container = document.getElementById('variant-container');

            rams.forEach(ram => {
                ocs.forEach(oc => {
                    const html = `
                    <div class="border p-3 mb-2 variant-item">
                        <div class="row">
                            <div class="col"><label>RAM</label><input type="hidden" name="variants[${variantIndex}][ram_id]" value="${ram.value}" class="form-control" readonly> <input type="text" value="${ram.nextElementSibling.innerText}" class="form-control" disabled></div>
                            <div class="col"><label>Ổ cứng</label><input type="hidden" name="variants[${variantIndex}][o_cung_id]" value="${oc.value}" class="form-control" readonly> <input type="text" value="${oc.nextElementSibling.innerText}" class="form-control" disabled></div>
                            <div class="col"><label>Giá</label><input type="number" name="variants[${variantIndex}][gia]" class="form-control"></div>
                            <div class="col"><label>Giá so sánh</label><input type="number" name="variants[${variantIndex}][gia_so_sanh]" class="form-control"></div>
                            <div class="col"><label>Tồn kho</label><input type="number" name="variants[${variantIndex}][ton_kho]" class="form-control"></div>
                            <div class="col-auto d-flex align-items-end"><button type="button" class="btn btn-danger btn-sm remove-variant">Xóa</button></div>
                        </div>
                    </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                    variantIndex++;
                });
            });

            document.getElementById('bulk-variant-form').style.display = 'none';
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-variant')) {
                if (confirm('Bạn có chắc chắn muốn xóa biến thể này?')) {
                    e.target.closest('.variant-item').remove();
                }
            }
        });

        function toggleSimpleProductFields() {
            var coBienThe = document.querySelector('input[name="co_bien_the"]:checked').value;
            document.getElementById('simple-product-fields').style.display = (coBienThe == '0') ? 'block' : 'none';
            document.querySelectorAll('.bien-the-section').forEach(function(el) {
                el.style.display = (coBienThe == '1') ? '' : 'none';
            });
        }
        document.querySelectorAll('input[name="co_bien_the"]').forEach(function(radio) {
            radio.addEventListener('change', toggleSimpleProductFields);
        });
        window.onload = toggleSimpleProductFields;
    </script>
@endpush
@section('js-custom')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mo_ta',
            height: 300,
            plugins: 'image link table lists code',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | image link table | code',
            menubar: false
        });
    </script>
@endsection
