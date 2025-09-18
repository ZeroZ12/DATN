<div class="overlay"></div>
<aside class="page-sidebar" data-sidebar-layout="stroke-svg">
    <div class="left-arrow" id="left-arrow">
        <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left">
            </use>
        </svg>
    </div>
    <div id="sidebar-menu">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="pin-title sidebar-list p-0"></li>
            <li class="line pin-line"></li>
            
            {{-- DashBoard --}}
            <li class="sidebar-list">
                <a href="{{ route('admin.index') }}" class="sidebar-link d-flex text-start" style="padding-left: 15px;">
                    <span class="flex-grow-1">Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-list">
                <a href="{{ route('admin.thongke') }}" class="sidebar-link d-flex text-start" style="padding-left: 15px;">
                    <span class="flex-grow-1">Thống kê</span>
                </a>
            </li>
            
            {{-- Quản lý chung --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex text-start" href="javascript:void(0)" style="padding-left: 15px;">
                    <span class="flex-grow-1">Quản lý chung</span>
                    <svg class="feather ms-auto" style="width: 16px; height: 16px;">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.sanpham.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.danhmuc.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banner.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Banner</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.danhgias.index') }}"
                            class="d-flex text-start {{ Request::routeIs('admin.danhgias.*') ? 'active' : '' }}" style="padding-left: 35px;">
                            <span class="flex-grow-1">Quản lý Đánh giá</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Quản lý phần cứng --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex text-start" href="javascript:void(0)" style="padding-left: 15px;">
                    <span class="flex-grow-1">Quản lý phần cứng</span>
                    <svg class="feather ms-auto" style="width: 16px; height: 16px;">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.chip.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Chip</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mainboard.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Mainboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gpu.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">GPU</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ram.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">RAM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ocung.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Ổ cứng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.nguon.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Nguồn</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tannhiet.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Tản Nhiệt</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.case.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Case</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Thương hiệu & Khuyến mãi --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex text-start" href="javascript:void(0)" style="padding-left: 15px;">
                    <span class="flex-grow-1">Thương hiệu & KM</span>
                    <svg class="feather ms-auto" style="width: 16px; height: 16px;">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.thuonghieu.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Thương hiệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sukien.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Sự kiện</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.magiamgia.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Mã giảm giá</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Thanh toán --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex text-start" href="javascript:void(0)" style="padding-left: 15px;">
                    <span class="flex-grow-1">Thanh toán</span>
                    <svg class="feather ms-auto" style="width: 16px; height: 16px;">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.phuongthucthanhtoan.index') }}" class="d-flex text-start" style="padding-left: 35px;">
                            <span class="flex-grow-1">Phương thức thanh toán</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-list mt-3">
                <a href="{{ route('admin.don-hang.index') }}" class="sidebar-link d-flex text-start" style="padding-left: 15px;">
                    <span class="flex-grow-1">Quản lý đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-list mt-3">
                <a href="{{ route('client.home') }}" class="sidebar-link d-flex text-start" style="padding-left: 15px;">
                    <span class="flex-grow-1">Trang chủ WEB</span>
                </a>
            </li>

            <li class="line"></li>
        </ul>
    </div>
</aside>