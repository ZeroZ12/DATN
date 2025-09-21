@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa sản phẩm: {{ $sanpham->ten }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.sanpham.update', $sanpham->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Loại sản phẩm</h5>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary btn-toggle">
                            <input type="radio" name="co_bien_the" value="1"
                                {{ old('co_bien_the', $sanpham->co_bien_the) == 1 ? 'checked' : '' }}>
                            <i class="fas fa-boxes"></i> Có biến thể
                        </label>
                        <label class="btn btn-outline-primary btn-toggle">
                            <input type="radio" name="co_bien_the" value="0"
                                {{ old('co_bien_the', $sanpham->co_bien_the) == 0 ? 'checked' : '' }}>
                            <i class="fas fa-box"></i> Không có biến thể
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="ten">Tên sản phẩm</label>
                <input type="text" name="ten" class="form-control" value="{{ old('ten', $sanpham->ten) }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="6">{!! old('mo_ta', $sanpham->mo_ta) !!}</textarea>
                @error('mo_ta')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3 variant-section">
                <div class="col">
                    <label>Chip</label>
                    <select name="id_chip" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($chips as $chip)
                            <option value="{{ $chip->id }}" data-price="{{ $chip->gia }}"
                                {{ old('id_chip', $sanpham->id_chip) == $chip->id ? 'selected' : '' }}>
                                {{ $chip->ten }}
                                ({{ number_format($chip->gia) }}đ{{ $chip->gia_sale ? ' - Sale: ' . number_format($chip->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Mainboard</label>
                    <select name="id_mainboard" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($mainboards as $mb)
                            <option value="{{ $mb->id }}" data-price="{{ $mb->gia }}"
                                {{ old('id_mainboard', $sanpham->id_mainboard) == $mb->id ? 'selected' : '' }}>
                                {{ $mb->ten }}
                                ({{ number_format($mb->gia) }}đ{{ $mb->gia_sale ? ' - Sale: ' . number_format($mb->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>GPU</label>
                    <select name="id_gpu" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($gpus as $gpu)
                            <option value="{{ $gpu->id }}" data-price="{{ $gpu->gia }}"
                                {{ old('id_gpu', $sanpham->id_gpu) == $gpu->id ? 'selected' : '' }}>
                                {{ $gpu->ten }}
                                ({{ number_format($gpu->gia) }}đ{{ $gpu->gia_sale ? ' - Sale: ' . number_format($gpu->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Tản Nhiệt</label>
                    <select name="id_tannhiet" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($tannhiets as $tannhiet)
                            <option value="{{ $tannhiet->id }}" data-price="{{ $tannhiet->gia }}"
                                {{ old('id_tannhiet', $sanpham->id_tannhiet) == $tannhiet->id ? 'selected' : '' }}>
                                {{ $tannhiet->ten }}
                                ({{ number_format($tannhiet->gia) }}đ{{ $tannhiet->gia_sale ? ' - Sale: ' . number_format($tannhiet->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Nguồn</label>
                    <select name="id_nguon" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($nguons as $nguon)
                            <option value="{{ $nguon->id }}" data-price="{{ $nguon->gia }}"
                                {{ old('id_nguon', $sanpham->id_nguon) == $nguon->id ? 'selected' : '' }}>
                                {{ $nguon->ten }}
                                ({{ number_format($nguon->gia) }}đ{{ $nguon->gia_sale ? ' - Sale: ' . number_format($nguon->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>Case</label>
                    <select name="id_case" class="form-select">
                        <option value="">-- Không chọn --</option>
                        @foreach ($cases as $case)
                            <option value="{{ $case->id }}" data-price="{{ $case->gia }}"
                                {{ old('id_case', $sanpham->id_case) == $case->id ? 'selected' : '' }}>
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
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($danhmucs as $dm)
                            <option value="{{ $dm->id }}"
                                {{ old('id_category', $sanpham->id_category) == $dm->id ? 'selected' : '' }}>
                                {{ $dm->ten }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label>Thương hiệu</label>
                    <select name="id_brand" class="form-select">
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach ($thuonghieus as $th)
                            <option value="{{ $th->id }}"
                                {{ old('id_brand', $sanpham->id_brand) == $th->id ? 'selected' : '' }}>
                                {{ $th->ten }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_brand')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label>Bảo hành (tháng)</label>
                    <input type="number" name="bao_hanh_thang" class="form-control"
                        value="{{ old('bao_hanh_thang', $sanpham->bao_hanh_thang) }}">
                    @error('bao_hanh_thang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="anh_dai_dien">Ảnh đại diện</label>
                @if ($sanpham->anh_dai_dien)
                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" width="150" class="mb-2 rounded">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
                <input type="file" name="anh_dai_dien" class="form-control">
                @error('anh_dai_dien')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="anh_phu">Ảnh phụ</label>
                @if ($sanpham->anhPhu && $sanpham->anhPhu->count() > 0)
                    <div class="mb-2">
                        @foreach ($sanpham->anhPhu as $anh)
                            <div class="d-inline-block position-relative me-2">
                                <img src="{{ asset('storage/' . $anh->duong_dan) }}" width="100" class="rounded">
                                <input type="checkbox" name="xoa_anh_phu[]" value="{{ $anh->id }}"> Xóa
                            </div>
                        @endforeach
                    </div>
                @else
                    <span class="text-muted">Không có ảnh phụ</span>
                @endif
                <input type="file" name="anh_phu[]" multiple class="form-control">
                @error('anh_phu.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="hoat_dong">Hoạt động</label>
                <input type="checkbox" name="hoat_dong" id="hoat_dong"
                    {{ old('hoat_dong', $sanpham->hoat_dong) ? 'checked' : '' }}>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="simple-product-fields" style="display: {{ $sanpham->co_bien_the ? 'none' : 'block' }};">
                <div class="form-group mb-3">
                    <label for="gia">Giá</label>
                    <input type="number" name="gia" class="form-control" step="0.01" min="0"
                        value="{{ old('gia', $sanpham->gia) }}">
                    @error('gia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="gia_so_sanh">Giá gốc</label>
                    <input type="number" name="gia_so_sanh" class="form-control" step="0.01" min="0"
                        value="{{ old('gia_so_sanh', $sanpham->gia_so_sanh) }}">
                    @error('gia_so_sanh')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="so_luong">Số lượng</label>
                    <input type="number" name="so_luong" class="form-control" min="0"
                        value="{{ old('so_luong', $sanpham->so_luong) }}">
                    @error('so_luong')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="variant-section" style="display: {{ $sanpham->co_bien_the ? 'block' : 'none' }};">
                <hr>
                <div class="form-group mb-3">
                    <label>Chọn RAM</label><br>
                    @foreach ($rams as $ram)
                        <label class="me-3">
                            <input type="checkbox" class="ram-checkbox" value="{{ $ram->id }}"
                                data-label="{{ $ram->dung_luong }}" data-price="{{ $ram->gia }}"
                                {{ $sanpham->bienTheSanPhams->contains('id_ram', $ram->id) ? 'checked' : '' }}>
                            {{ $ram->dung_luong }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group mb-3">
                    <label>Chọn Ổ Cứng</label><br>
                    @foreach ($o_cungs as $oc)
                        <label class="me-3">
                            <input type="checkbox" class="ocung-checkbox" value="{{ $oc->id }}"
                                data-label="{{ $oc->dung_luong }}" data-price="{{ $oc->gia }}"
                                {{ $sanpham->bienTheSanPhams->contains('id_o_cung', $oc->id) ? 'checked' : '' }}>
                            {{ $oc->loai }}-{{ $oc->dung_luong }}
                        </label>
                    @endforeach
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Giá áp dụng cho tất cả</label>
                        <input type="number" step="0.01" id="global-price" class="form-control" value="0">
                        <label>Tổng giá PC: <span id="tong-gia-linh-kien" class="fw-bold text-danger">0</span> đ</label>
                    </div>
                    <div class="col-md-4">
                        <label>Giá gốc áp dụng</label>
                        <input type="number" step="0.01" id="global-price-compare" class="form-control">
                    </div>
                </div>

                <h5 class="mt-4">Danh sách biến thể</h5>
                <table class="table table-bordered table-hover table-light" id="variant-table">
                    <thead>
                        <tr>
                            <th>RAM</th>
                            <th>Ổ Cứng</th>
                            <th>Giá</th>
                            <th>Giá Gốc</th>
                            <th>Tồn Kho</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sanpham->bienTheSanPhams as $i => $variant)
                            <tr>
                                <td>{{ $variant->ram->dung_luong }}<input type="hidden"
                                        name="variants[{{ $i }}][id]" value="{{ $variant->id }}"><input
                                        type="hidden" name="variants[{{ $i }}][ram_id]"
                                        value="{{ $variant->id_ram }}"></td>
                                <td>{{ $variant->oCung->dung_luong }}<input type="hidden"
                                        name="variants[{{ $i }}][o_cung_id]"
                                        value="{{ $variant->id_o_cung }}"></td>
                                <td><input type="number" step="0.01" name="variants[{{ $i }}][gia]"
                                        class="form-control" value="{{ $variant->gia }}" required></td>
                                <td><input type="number" step="0.01"
                                        name="variants[{{ $i }}][gia_so_sanh]" class="form-control"
                                        value="{{ $variant->gia_so_sanh }}"></td>
                                <td><input type="number" name="variants[{{ $i }}][ton_kho]"
                                        class="form-control" value="{{ $variant->ton_kho }}" required></td>
                                <td><button type="button" class="btn btn-danger btn-sm remove-variant"><i
                                            class="fas fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật sản phẩm</button>
                <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                    Quay lại</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const ramCheckboxes = document.querySelectorAll('.ram-checkbox');
        const ocungCheckboxes = document.querySelectorAll('.ocung-checkbox');
        const variantTableBody = document.querySelector('#variant-table tbody');

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
            document.querySelectorAll('.ram-checkbox:checked').forEach(cb => {
                tong += parseFloat(cb.dataset.price || 0);
            });
            document.querySelectorAll('.ocung-checkbox:checked').forEach(cb => {
                tong += parseFloat(cb.dataset.price || 0);
            });
            document.getElementById('tong-gia-linh-kien').innerText = tong.toLocaleString();
        }

        document.querySelectorAll('select').forEach(el => {
            el.addEventListener('change', () => {
                tinhTongGiaLinhKien();
                renderVariants();
            });
        });

        function renderVariants() {
            const existingVariants = Array.from(variantTableBody.querySelectorAll('tr')).map(row => ({
                ram_id: row.querySelector('input[name*="[ram_id]"]').value,
                o_cung_id: row.querySelector('input[name*="[o_cung_id]"]').value
            }));

            const rams = Array.from(ramCheckboxes).filter(cb => cb.checked);
            const ocs = Array.from(ocungCheckboxes).filter(cb => cb.checked);

            let globalPrice = document.getElementById('global-price').value;
            if (!globalPrice || isNaN(globalPrice) || Number(globalPrice) === 0) {
                let tongGia = document.getElementById('tong-gia-linh-kien').innerText.replace(/[^\d]/g, '');
                globalPrice = tongGia ? parseInt(tongGia) : 0;
            }
            const globalPriceCompare = document.getElementById('global-price-compare').value;
            let index = variantTableBody.querySelectorAll('tr').length;

            rams.forEach(ram => {
                ocs.forEach(oc => {
                    if (!existingVariants.some(v => v.ram_id === ram.value && v.o_cung_id === oc.value)) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${ram.dataset.label}<input type="hidden" name="variants[${index}][ram_id]" value="${ram.value}"></td>
                            <td>${oc.dataset.label}<input type="hidden" name="variants[${index}][o_cung_id]" value="${oc.value}"></td>
                            <td><input type="number" step="0.01" name="variants[${index}][gia]" class="form-control" value="${globalPriceCompare}" required></td>
                            <td><input type="number" step="0.01" name="variants[${index}][gia_so_sanh]" class="form-control" value="${globalPrice}"></td>
                            <td><input type="number" name="variants[${index}][ton_kho]" class="form-control" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fas fa-trash"></i></button></td>
                        `;
                        variantTableBody.appendChild(row);
                        index++;
                    }
                });
            });

            document.querySelectorAll('.remove-variant').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('tr').remove();
                });
            });
        }

        ramCheckboxes.forEach(cb => cb.addEventListener('change', () => {
            tinhTongGiaLinhKien();
            renderVariants();
        }));
        ocungCheckboxes.forEach(cb => cb.addEventListener('change', () => {
            tinhTongGiaLinhKien();
            renderVariants();
        }));
        document.getElementById('global-price').addEventListener('input', renderVariants);
        document.getElementById('global-price-compare').addEventListener('input', renderVariants);

        function toggleSimpleProductFields() {
            var coBienThe = document.querySelector('input[name="co_bien_the"]:checked').value;
            document.getElementById('simple-product-fields').style.display = (coBienThe == '0') ? 'block' : 'none';
            document.querySelector('.variant-section').style.display = (coBienThe == '1') ? 'block' : 'none';
        }

        document.querySelectorAll('input[name="co_bien_the"]').forEach(function(radio) {
            radio.addEventListener('change', toggleSimpleProductFields);
        });

        window.onload = function() {
            tinhTongGiaLinhKien();
            renderVariants();
            toggleSimpleProductFields();
        };
    </script>
@endpush
@push('styles')
    <style>
        .btn-primary,
        .btn-warning {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary:hover,
        .btn-warning:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        .btn-secondary {
            transition: all 0.2s ease-in-out;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
        }

        .btn-toggle {
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-toggle input:checked+.btn {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
        }

        .btn-toggle input:checked+.btn:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
        }

        .btn-toggle .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
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
