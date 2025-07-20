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
                <a href="{{ route('admin.index') }}" class="sidebar-link d-flex align-items-center">
                    <span class="me-2" style="width: 1.25em; display: inline-block;"></span>
                    <span class="flex-grow-1">Dashboard</span>
                </a>
            </li>
            {{-- Quản lý chung --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex align-items-center" href="javascript:void(0)">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                    </svg>
                    <span class="flex-grow-1">Quản lý chung</span>
                    <svg class="feather ms-auto">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.sanpham.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-cube me-2"></i>
                            <span class="flex-grow-1">Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.danhmuc.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-list me-2"></i>
                            <span class="flex-grow-1">Danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-users me-2"></i>
                            <span class="flex-grow-1">Người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.danhgias.index') }}"
                            class="d-flex align-items-center {{ Request::routeIs('admin.danhgias.*') ? 'active' : '' }}">
                            <i class="fa fa-star me-2"></i>
                            <span class="flex-grow-1">Quản lý Đánh giá</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Quản lý phần cứng --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex align-items-center" href="javascript:void(0)">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Setting"></use>
                    </svg>
                    <span class="flex-grow-1">Quản lý phần cứng</span>
                    <svg class="feather ms-auto">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.chip.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-microchip me-2"></i>
                            <span class="flex-grow-1">Chip</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mainboard.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-server me-2"></i>
                            <span class="flex-grow-1">Mainboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gpu.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-video me-2"></i>
                            <span class="flex-grow-1">GPU</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ram.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-memory me-2"></i>
                            <span class="flex-grow-1">RAM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ocung.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-hdd me-2"></i>
                            <span class="flex-grow-1">Ổ cứng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.nguon.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-plug me-2"></i>
                            <span class="flex-grow-1">Nguồn</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tannhiet.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-fan me-2"></i>
                            <span class="flex-grow-1">Tản Nhiệt</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.case.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-desktop me-2"></i>
                            <span class="flex-grow-1">Case</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Thương hiệu & Khuyến mãi --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex align-items-center" href="javascript:void(0)">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Discount"></use>
                    </svg>
                    <span class="flex-grow-1">Thương hiệu & KM</span>
                    <svg class="feather ms-auto">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.thuonghieu.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-star me-2"></i>
                            <span class="flex-grow-1">Thương hiệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sukien.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-bolt me-2"></i>
                            <span class="flex-grow-1">Sự kiện</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.magiamgia.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-gift me-2"></i>
                            <span class="flex-grow-1">Mã giảm giá</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banner.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-image me-2"></i>
                            <span class="flex-grow-1">Banner</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Thanh toán --}}
            <li class="sidebar-list">
                <a class="sidebar-link d-flex align-items-center" href="javascript:void(0)">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                    </svg>
                    <span class="flex-grow-1">Thanh toán</span>
                    <svg class="feather ms-auto">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right">
                        </use>
                    </svg>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.phuongthucthanhtoan.index') }}" class="d-flex align-items-center">
                            <i class="fa fa-credit-card me-2"></i>
                            <span class="flex-grow-1">Phương thức thanh toán</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-list mt-3">
                <a href="{{ route('admin.don-hang.index') }}" class="sidebar-link d-flex align-items-center">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                    </svg>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-list mt-3">
                <a href="{{ route('client.home') }}" class="sidebar-link d-flex align-items-center">
                    <svg class="stroke-icon me-2">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                    </svg>
                    <span>Trang chủ WEB</span>
                </a>
            </li>

            <li class="line"></li>
        </ul>
    </div>
</aside>
