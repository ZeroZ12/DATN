<aside class="page-sidebar bg-white shadow-sm border-end"
    style="min-height: 100vh; width: 280px; padding: 2rem; font-size: 0.85rem;">
    <h6 class="text-primary text-uppercase fw-bold mb-4">Bảng điều khiển</h6>

    <div class="mb-4">
        <p class="text-muted small fw-semibold mb-2">📁 Trang chính</p>
        <select id="menuGeneral"
            class="form-select form-select-sm rounded border-0 bg-light text-dark fw-medium px-2 py-1"
            onchange="if (this.value) window.location.href=this.value">
            <option disabled selected>🔽 Chọn mục...</option>
            <option value="{{ route('admin.sanpham.index') }}">🖥️ Sản phẩm</option>
            <option value="{{ route('admin.danhmuc.index') }}">📂 Danh mục</option>
        </select>
    </div>

    <div class="mb-4">
        <p class="text-muted small fw-semibold mb-2">💻 Cấu hình phần cứng</p>
        <select id="menuHardware"
            class="form-select form-select-sm rounded border-0 bg-light text-dark fw-medium px-2 py-1"
            onchange="if (this.value) window.location.href=this.value">
            <option disabled selected>🔽 Chọn phần cứng...</option>
            <option value="{{ route('admin.chip.index') }}">⚙️ Chip</option>
            <option value="{{ route('admin.mainboard.index') }}">🧩 Mainboard</option>
            <option value="{{ route('admin.gpu.index') }}">🎮 GPU</option>
            <option value="{{ route('admin.ram.index') }}">💾 RAM</option>
            <option value="{{ route('admin.ocung.index') }}">🗄️ Ổ cứng</option>
        </select>
    </div>

    <div class="mb-4">
        <p class="text-muted small fw-semibold mb-2">🏷️ Thương hiệu & khuyến mãi</p>
        <select id="menuBrand"
            class="form-select form-select-sm rounded border-0 bg-light text-dark fw-medium px-2 py-1"
            onchange="if (this.value) window.location.href=this.value">
            <option disabled selected>🔽 Chọn mục...</option>
            <option value="{{ route('admin.thuonghieu.index') }}">⭐ Thương hiệu</option>
            <option value="{{ route('admin.magiamgia.index') }}">🎟️ Mã giảm giá</option>
        </select>
    </div>

    <div class="mb-4">
        <p class="text-muted small fw-semibold mb-2">💰 Thanh toán</p>
        <select id="menuPayment"
            class="form-select form-select-sm rounded border-0 bg-light text-dark fw-medium px-2 py-1"
            onchange="if (this.value) window.location.href=this.value">
            <option disabled selected>🔽 Chọn phương thức...</option>
            <option value="{{ route('admin.phuongthucthanhtoan.index') }}">💳 Phương thức thanh toán</option>
        </select>
    </div>
</aside>
