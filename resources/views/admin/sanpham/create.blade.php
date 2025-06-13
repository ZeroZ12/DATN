@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
    <div class="container">
        <h1>Thêm sản phẩm mới</h1>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.sanpham.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="ten">Tên sản phẩm</label>
                <input type="text" name="ten" id="ten" class="form-control" value="{{ old('ten') }}">
                @error('ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="mo_ta">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_category">Danh mục</label>
                <select name="id_category" id="id_category" class="form-control">
                    <option value="">Chọn danh mục</option>
                    @foreach ($danhmucs as $danhmuc)
                        <option value="{{ $danhmuc->id }}" {{ old('id_category') == $danhmuc->id ? 'selected' : '' }}>
                            {{ $danhmuc->ten }}</option>
                    @endforeach
                </select>
                @error('id_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_brand">Thương hiệu</label>
                <select name="id_brand" id="id_brand" class="form-control">
                    <option value="">Chọn thương hiệu</option>
                    @foreach ($thuonghieus as $thuonghieu)
                        <option value="{{ $thuonghieu->id }}" {{ old('id_brand') == $thuonghieu->id ? 'selected' : '' }}>
                            {{ $thuonghieu->ten }}</option>
                    @endforeach
                </select>
                @error('id_brand')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_chip">Chip</label>
                <select name="id_chip" id="id_chip" class="form-control">
                    <option value="">Chọn chip</option>
                    @foreach ($chips as $chip)
                        <option value="{{ $chip->id }}" {{ old('id_chip') == $chip->id ? 'selected' : '' }}>
                            {{ $chip->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_chip')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_mainboard">Mainboard</label>
                <select name="id_mainboard" id="id_mainboard" class="form-control">
                    <option value="">Chọn mainboard</option>
                    @foreach ($mainboards as $mainboard)
                        <option value="{{ $mainboard->id }}"
                            {{ old('id_mainboard') == $mainboard->id ? 'selected' : '' }}>
                            {{ $mainboard->ten }}</option>
                    @endforeach
                </select>
                @error('id_mainboard')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="id_gpu">GPU</label>
                <select name="id_gpu" id="id_gpu" class="form-control">
                    <option value="">Chọn GPU</option>
                    @foreach ($gpus as $gpu)
                        <option value="{{ $gpu->id }}" {{ old('id_gpu') == $gpu->id ? 'selected' : '' }}>
                            {{ $gpu->ten }}
                        </option>
                    @endforeach
                </select>
                @error('id_gpu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="bao_hanh_thang">Bảo hành (tháng)</label>
                <input type="number" name="bao_hanh_thang" id="bao_hanh_thang" class="form-control"
                    value="{{ old('bao_hanh_thang', 12) }}"> {{-- Mặc định bảo hành 12 tháng --}}
                @error('bao_hanh_thang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="hoat_dong">Hoạt động</label>
                {{-- Mặc định checkbox được tích khi tạo mới --}}
                <input type="checkbox" name="hoat_dong" id="hoat_dong" {{ old('hoat_dong', true) ? 'checked' : '' }}>
                @error('hoat_dong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="anh_dai_dien">Ảnh đại diện</label>
                <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control">
                @error('anh_dai_dien')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="anh_phu">Ảnh phụ (tùy chọn):</label>
                <input type="file" name="anh_phu[]" id="anh_phu" multiple class="form-control">
                @error('anh_phu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <h2>Quản lý biến thể sản phẩm</h2>

            {{-- Các checkbox chọn RAM và Ổ Cứng để thêm biến thể mới --}}
            <div class="form-group mb-3">
                <label>Chọn RAM cho biến thể:</label><br>
                <div class="d-flex flex-wrap">
                    @foreach ($rams as $ram)
                        <label class="me-3 mb-2">
                            <input type="checkbox" class="ram-checkbox" value="{{ $ram->id }}"
                                data-label="{{ $ram->dung_luong }}"
                                {{ in_array($ram->id, explode(',', old('selected_ram_ids', ''))) ? 'checked' : '' }}>
                            {{ $ram->dung_luong }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Chọn Ổ Cứng cho biến thể:</label><br>
                <div class="d-flex flex-wrap">
                    @foreach ($o_cungs as $oc)
                        <label class="me-3 mb-2">
                            <input type="checkbox" class="ocung-checkbox" value="{{ $oc->id }}"
                                data-label="{{ $oc->dung_luong }}"
                                {{ in_array($oc->id, explode(',', old('selected_ocung_ids', ''))) ? 'checked' : '' }}>
                            {{ $oc->dung_luong }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Input hidden để lưu trạng thái checkbox RAM/OC cho old() --}}
            <input type="hidden" name="selected_ram_ids" id="selected_ram_ids_input">
            <input type="hidden" name="selected_ocung_ids" id="selected_ocung_ids_input">

            {{-- Input giá chung và tồn kho chung cho biến thể mới --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="global-price">Giá áp dụng cho biến thể mới</label>
                    <input type="number" step="0.01" id="global-price" class="form-control"
                        value="{{ old('global_price') }}">
                </div>
                <div class="col-md-4">
                    <label for="global-price-compare">Giá so sánh áp dụng cho biến thể mới</label>
                    <input type="number" step="0.01" id="global-price-compare" class="form-control"
                        value="{{ old('global_price_compare') }}">
                </div>
                <div class="col-md-4">
                    <label for="global-ton_kho">Tồn kho áp dụng cho biến thể mới</label>
                    <input type="number" id="global-ton_kho" class="form-control" value="{{ old('global_ton_kho') }}">
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
                        <th>Ảnh</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Các biến thể mới được tạo bởi JS sẽ được thêm vào đây --}}
                </tbody>
            </table>
            @error('variants')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('variants.*.gia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('variants.*.ton_kho')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const ramCheckboxes = document.querySelectorAll('.ram-checkbox');
        const ocungCheckboxes = document.querySelectorAll('.ocung-checkbox');
        const variantTableBody = document.querySelector('#variant-table tbody');
        const globalPriceInput = document.getElementById('global-price');
        const globalPriceCompareInput = document.getElementById('global-price-compare');
        const globalTonKhoInput = document.getElementById('global-ton_kho');

        let nextVariantIndex = 0; // Bắt đầu từ 0 cho form create

        // Hàm để cập nhật giá trị các trường input của biến thể mới khi giá chung thay đổi
        function updateNewVariantInputs() {
            const globalPrice = globalPriceInput.value;
            const globalPriceCompare = globalPriceCompareInput.value;
            const globalTonKho = globalTonKhoInput.value;

            // Chỉ cập nhật các biến thể mới được tạo bởi JS (có data-new-variant='true')
            variantTableBody.querySelectorAll('tr[data-new-variant="true"]').forEach(row => {
                const priceInput = row.querySelector('input[name$="[gia]"]');
                const priceCompareInput = row.querySelector('input[name$="[gia_so_sanh]"]');
                const tonKhoInput = row.querySelector('input[name$="[ton_kho]"]');

                if (priceInput) priceInput.value = globalPrice;
                if (priceCompareInput) priceCompareInput.value = globalPriceCompare;
                if (tonKhoInput) tonKhoInput.value = globalTonKho;
            });
        }

        // Hàm để render/cập nhật bảng biến thể
        function renderVariants() {
            // Lấy tất cả các cặp (ram_id, ocung_id) hiện có trong bảng
            const existingCombinations = new Set();
            variantTableBody.querySelectorAll('tr').forEach(row => {
                const ramId = row.querySelector('input[name$="[ram_id]"]')?.value;
                const ocungId = row.querySelector('input[name$="[o_cung_id]"]')?.value;
                if (ramId && ocungId) {
                    existingCombinations.add(`${ramId}-${ocungId}`);
                }
            });

            const selectedRams = Array.from(ramCheckboxes).filter(cb => cb.checked);
            const selectedOcs = Array.from(ocungCheckboxes).filter(cb => cb.checked);
            const globalPrice = globalPriceInput.value;
            const globalPriceCompare = globalPriceCompareInput.value;
            const globalTonKho = globalTonKhoInput.value;

            // Tập hợp các tổ hợp (RAM-OC) cần có trong bảng
            const requiredCombinations = new Set();
            selectedRams.forEach(ram => {
                selectedOcs.forEach(oc => {
                    requiredCombinations.add(`${ram.value}-${oc.value}`);
                });
            });

            // Xóa các biến thể không còn được chọn
            // Duyệt ngược để tránh vấn đề về chỉ mục khi xóa phần tử
            for (let i = variantTableBody.children.length - 1; i >= 0; i--) {
                const row = variantTableBody.children[i];
                const ramId = row.querySelector('input[name$="[ram_id]"]')?.value;
                const ocungId = row.querySelector('input[name$="[o_cung_id]"]')?.value;
                const combination = `${ramId}-${ocungId}`;

                // Chỉ xóa các biến thể được tạo bởi JS (không có data-variant-id)
                if (row.hasAttribute('data-new-variant') && !requiredCombinations.has(combination)) {
                    row.remove();
                }
            }

            // Thêm các biến thể mới nếu chúng chưa tồn tại trong bảng
            selectedRams.forEach(ram => {
                selectedOcs.forEach(oc => {
                    const combination = `${ram.value}-${oc.value}`;
                    if (!existingCombinations.has(combination)) { // Nếu tổ hợp chưa tồn tại
                        const row = document.createElement('tr');
                        row.setAttribute('data-new-variant', 'true'); // Đánh dấu là biến thể mới
                        row.innerHTML = `
                            <td>${ram.dataset.label}<input type="hidden" name="variants[${nextVariantIndex}][ram_id]" value="${ram.value}"></td>
                            <td>${oc.dataset.label}<input type="hidden" name="variants[${nextVariantIndex}][o_cung_id]" value="${oc.value}"></td>
                            <td><input type="number" step="0.01" name="variants[${nextVariantIndex}][gia]" class="form-control" value="${globalPrice}" required></td>
                            <td><input type="number" step="0.01" name="variants[${nextVariantIndex}][gia_so_sanh]" class="form-control" value="${globalPriceCompare}"></td>
                            <td><input type="number" name="variants[${nextVariantIndex}][ton_kho]" class="form-control" value="${globalTonKho}" required></td>
                            <td><input type="file" name="variants[${nextVariantIndex}][anh_dai_dien]" class="form-control form-control-sm"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-new-variant">Xóa</button></td>
                        `;
                        variantTableBody.appendChild(row);
                        nextVariantIndex++; // Tăng chỉ mục cho biến thể tiếp theo
                    }
                });
            });

            // Gắn lại sự kiện cho các nút xóa biến thể mới được tạo
            document.querySelectorAll('.remove-new-variant').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('tr').remove();
                });
            });

            // Sau khi thêm/xóa, cập nhật lại giá trị cho các input của biến thể mới
            updateNewVariantInputs();
        }

        // Hàm để cập nhật input hidden chứa các ID RAM/OC đã chọn
        function updateHiddenSelectedIds() {
            const selectedRams = Array.from(ramCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
            const selectedOcs = Array.from(ocungCheckboxes).filter(cb => cb.checked).map(cb => cb.value);

            document.getElementById('selected_ram_ids_input').value = selectedRams.join(',');
            document.getElementById('selected_ocung_ids_input').value = selectedOcs.join(',');
        }


        // Lắng nghe sự kiện thay đổi của checkbox RAM và Ổ Cứng
        ramCheckboxes.forEach(cb => cb.addEventListener('change', function() {
            renderVariants();
            updateHiddenSelectedIds();
        }));
        ocungCheckboxes.forEach(cb => cb.addEventListener('change', function() {
            renderVariants();
            updateHiddenSelectedIds();
        }));

        // Lắng nghe sự kiện nhập của giá chung và tồn kho chung
        globalPriceInput.addEventListener('input', updateNewVariantInputs);
        globalPriceCompareInput.addEventListener('input', updateNewVariantInputs);
        globalTonKhoInput.addEventListener('input', updateNewVariantInputs);


        // Sau khi trang tải, kiểm tra lại các checkbox nếu có dữ liệu old input (sau lỗi validation)
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy lại các giá trị RAM và Ổ cứng đã chọn nếu có lỗi validation
            const oldSelectedRamIdsStr = document.getElementById('selected_ram_ids_input').value;
            const oldSelectedOcungIdsStr = document.getElementById('selected_ocung_ids_input').value;

            // Khôi phục trạng thái checkbox từ old input nếu có
            if (oldSelectedRamIdsStr) {
                const oldSelectedRamIds = oldSelectedRamIdsStr.split(',').map(id => parseInt(id));
                ramCheckboxes.forEach(cb => {
                    if (oldSelectedRamIds.includes(parseInt(cb.value))) {
                        cb.checked = true;
                    }
                });
            }
            if (oldSelectedOcungIdsStr) {
                const oldSelectedOcungIds = oldSelectedOcungIdsStr.split(',').map(id => parseInt(id));
                ocungCheckboxes.forEach(cb => {
                    if (oldSelectedOcungIds.includes(parseInt(cb.value))) {
                        cb.checked = true;
                    }
                });
            }

            renderVariants(); // Render biến thể dựa trên trạng thái checkbox ban đầu
            updateHiddenSelectedIds(); // Cập nhật hidden inputs ngay từ đầu
        });
    </script>
@endpush
