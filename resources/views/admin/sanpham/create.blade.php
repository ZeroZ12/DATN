@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="container">
        <h1>Tạo sản phẩm mới</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.sanpham.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Thông tin cơ bản --}}
            <div class="form-group">
                <label for="ten">Tên sản phẩm</label>
                <input type="text" name="ten" class="form-control" value="{{ old('ten') }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control"
                    rows="6">{!! old('mo_ta', $item->mo_ta ?? '') !!}</textarea>
                @error('mo_ta')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label for="mo_ta">Mô tả</label>
                <textarea name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
                @error('mo_ta') <div class="text-danger">{{ $message }}</div> @enderror
            </div> --}}

            {{-- Danh mục, thương hiệu, linh kiện --}}
            <div class="form-group">
                <label>Danh mục</label>
                <select name="id_category" class="form-control">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($danhmucs as $item)
                        <option value="{{ $item->id }}" {{ old('id_category') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Thương hiệu</label>
                <select name="id_brand" class="form-control">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($thuonghieus as $item)
                        <option value="{{ $item->id }}" {{ old('id_brand') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Chip</label>
                <select name="id_chip" class="form-control">
                    <option value="">-- Chọn chip --</option>
                    @foreach ($chips as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_chip') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                            ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_chip')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Mainboard</label>
                <select name="id_mainboard" class="form-control">
                    <option value="">-- Chọn mainboard --</option>
                    @foreach ($mainboards as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_mainboard') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                            ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_mainboard')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>GPU</label>
                <select name="id_gpu" class="form-control">
                    <option value="">-- Chọn GPU --</option>
                    @foreach ($gpus as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_gpu') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                            ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_gpu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Case</label>
                <select name="id_case" class="form-control">
                    <option value="">-- Chọn Case --</option>
                    @foreach ($cases as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_case') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                            ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_case')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tản nhiệt</label>
                <select name="id_tannhiet" class="form-control">
                    <option value="">-- Chọn Tản nhiệt --</option>
                    @foreach ($tannhiets as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_tannhiet') == $item->id ? 'selected' : '' }}>
                            {{ $item->ten }}
                            ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_tannhiet')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label>Nguồn</label>
                    <select name="id_nguon" class="form-control">
                        <option value="">-- Chọn Nguồn --</option>
                        @foreach ($nguons as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->gia }}" data-sale="{{ $item->gia_sale }}" {{ old('id_nguon') == $item->id ? 'selected' : '' }}>
                                {{ $item->ten }}
                                ({{ number_format($item->gia) }}đ{{ $item->gia_sale ? ' - Sale: ' . number_format($item->gia_sale) . 'đ' : '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_nguon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bao_hanh_thang">Bảo hành (tháng)</label>
                    <input type="number" name="bao_hanh_thang" class="form-control" value="{{ old('bao_hanh_thang') }}">
                    @error('bao_hanh_thang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="anh_dai_dien">Ảnh đại diện</label>
                    <input type="file" name="anh_dai_dien" class="form-control">
                    @error('anh_dai_dien')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="anh_phu">Ảnh phụ</label>
                    <input type="file" name="anh_phu[]" multiple class="form-control">
                    @error('anh_phu.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="hoat_dong">Hoạt động</label>
                    <input type="checkbox" name="hoat_dong" id="hoat_dong" {{ old('hoat_dong', true) ? 'checked' : '' }}>
                    @error('hoat_dong')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Chọn biến thể --}}
                <hr>
                <div class="form-group">
                    <label>Chọn RAM</label><br>
                    @foreach ($rams as $ram)
                        <label class="me-3">
                            <input type="checkbox" class="ram-checkbox" value="{{ $ram->id }}"
                                data-label="{{ $ram->dung_luong }}" data-price="{{ $ram->gia }}">
                            {{ $ram->dung_luong }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Chọn Ổ Cứng</label><br>
                    @foreach ($o_cungs as $oc)
                        <label class="me-3">
                            <input type="checkbox" class="ocung-checkbox" value="{{ $oc->id }}"
                                data-label="{{ $oc->dung_luong }}" data-price="{{ $oc->gia }}">
                            {{ $oc->dung_luong }}
                        </label>
                    @endforeach
                </div>

                {{-- Giá chung --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Giá áp dụng cho tất cả</label>
                        <input type="number" step="0.01" id="global-price" class="form-control" value="0">
                        <label>Tổng giá PC: <span id="tong-gia-linh-kien" class="fw-bold text-danger">0</span> đ</label>
                        {{-- <label>Tổng giá sale: <span id="tong-gia-sale" class="fw-bold text-success">0</span> đ</label> --}}
                    </div>
                    <div class="col-md-4">
                        <label>Giá so sánh áp dụng</label>
                        <input type="number" step="0.01" id="global-price-compare" class="form-control">
                    </div>
                </div>

                {{-- Bảng biến thể --}}
                <h5 class="mt-4">Danh sách biến thể</h5>
                <table class="table table-bordered" id="variant-table">
                    <thead>
                        <tr>
                            <th>RAM</th>
                            <th>Ổ Cứng</th>
                            <th>Giá</th>
                            <th>Giá So Sánh</th>
                            <th>Tồn Kho</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Quay lại</a>
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
            // Nếu có thêm các select khác, bổ sung vào đây
            // Cộng thêm giá RAM đã chọn
            document.querySelectorAll('.ram-checkbox:checked').forEach(cb => {
                tong += parseFloat(cb.dataset.price || 0);
            });
            // Cộng thêm giá ổ cứng đã chọn
            document.querySelectorAll('.ocung-checkbox:checked').forEach(cb => {
                tong += parseFloat(cb.dataset.price || 0);
            });
            document.getElementById('tong-gia-linh-kien').innerText = tong.toLocaleString();
        }

        // Gắn sự kiện cho tất cả select
        document.querySelectorAll('select').forEach(el => {
            el.addEventListener('change', () => {
                tinhTongGiaLinhKien();
                renderVariants();
            });
        });

        function updateVariantPrices() {
            let globalPrice = document.getElementById('global-price').value;
            if (!globalPrice || isNaN(globalPrice) || Number(globalPrice) === 0) {
                let tongGia = document.getElementById('tong-gia-linh-kien').innerText.replace(/[^\d]/g, '');
                globalPrice = tongGia ? parseInt(tongGia) : 0;
            }
            document.querySelectorAll('input[name^="variants"][name$="[gia]"]').forEach(input => {
                input.value = globalPrice;
            });
        }

        function getSelectedOptionSale(selector) {
            const select = document.querySelector(selector);
            if (!select) return 0;
            const selected = select.options[select.selectedIndex];
            return selected && selected.dataset.sale ? parseFloat(selected.dataset.sale) : 0;
        }

        // function tinhTongGiaSale() {
        //     let tongSale = 0;
        //     tongSale += getSelectedOptionSale('select[name="id_chip"]');
        //     tongSale += getSelectedOptionSale('select[name="id_mainboard"]');
        //     tongSale += getSelectedOptionSale('select[name="id_gpu"]');
        //     tongSale += getSelectedOptionSale('select[name="id_case"]');
        //     tongSale += getSelectedOptionSale('select[name="id_tannhiet"]');
        //     tongSale += getSelectedOptionSale('select[name="id_nguon"]');
        //     // Cộng thêm giá RAM đã chọn
        //     document.querySelectorAll('.ram-checkbox:checked').forEach(cb => {
        //         tong += parseFloat(cb.dataset.price || 0);
        //     });
        //     // Cộng thêm giá ổ cứng đã chọn
        //     document.querySelectorAll('.ocung-checkbox:checked').forEach(cb => {
        //         tong += parseFloat(cb.dataset.price || 0);
        //     });
        //     document.getElementById('tong-gia-sale').innerText = tongSale.toLocaleString();
        // }
        // document.querySelectorAll('select').forEach(el => {
        //     el.addEventListener('change', tinhTongGiaSale);
        // });

        // Gọi lần đầu
        tinhTongGiaLinhKien();
        // tinhTongGiaSale();

        function renderVariants() {
            variantTableBody.innerHTML = '';
            const rams = Array.from(ramCheckboxes).filter(cb => cb.checked);
            const ocs = Array.from(ocungCheckboxes).filter(cb => cb.checked);
            // Nếu input rỗng thì lấy tổng giá linh kiện, nếu không thì lấy giá nhập
            let globalPrice = document.getElementById('global-price').value;
            if (!globalPrice || isNaN(globalPrice) || Number(globalPrice) === 0) {
                let tongGia = document.getElementById('tong-gia-linh-kien').innerText.replace(/[^\d]/g, '');
                globalPrice = tongGia ? parseInt(tongGia) : 0;
            }
            const globalPriceCompare = document.getElementById('global-price-compare').value;
            let index = 0;

            rams.forEach(ram => {
                ocs.forEach(oc => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${ram.dataset.label}<input type="hidden" name="variants[${index}][ram_id]" value="${ram.value}"></td>
                        <td>${oc.dataset.label}<input type="hidden" name="variants[${index}][o_cung_id]" value="${oc.value}"></td>
                        <td><input type="number" step="0.01" name="variants[${index}][gia]" class="form-control" value="${globalPrice}" required></td>
                        <td><input type="number" step="0.01" name="variants[${index}][gia_so_sanh]" class="form-control" value="${globalPriceCompare}"></td>
                        <td><input type="number" name="variants[${index}][ton_kho]" class="form-control" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-variant">X</button></td>
                    `;
                    variantTableBody.appendChild(row);
                    index++;
                });
            });

            // Gắn nút xóa dòng
            document.querySelectorAll('.remove-variant').forEach(btn => {
                btn.addEventListener('click', function () {
                    this.closest('tr').remove();
                });
            });
        }
        ramCheckboxes.forEach(cb => cb.addEventListener('change', renderVariants));
        ocungCheckboxes.forEach(cb => cb.addEventListener('change', renderVariants));

        // Tự động render nếu người dùng đã nhập giá chung rồi chọn
        document.getElementById('global-price').addEventListener('input', renderVariants);
        document.getElementById('global-price-compare').addEventListener('input', renderVariants);

        renderVariants();
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