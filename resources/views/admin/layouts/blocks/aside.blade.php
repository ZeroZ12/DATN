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
                    <li><a href="{{ route('admin.sanpham.index') }}"><i class="fa fa-cube me-2"></i>Sản phẩm</a></li>
                    <li><a href="{{ route('admin.danhmuc.index') }}"><i class="fa fa-list me-2"></i>Danh mục</a></li>
                    <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users me-2"></i>Người dùng</a></li>
                    {{-- Thêm Quản lý Đánh giá vào đây --}}
                    <li>
                        <a href="{{ route('admin.danhgias.index') }}" class="{{ Request::routeIs('admin.danhgias.*') ? 'active' : '' }}">
                            <i class="fas fa-star me-2"></i>Quản lý Đánh giá
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
                    <li><a href="{{ route('admin.chip.index') }}"><i class="fa fa-microchip me-2"></i>Chip</a></li>
                    <li><a href="{{ route('admin.mainboard.index') }}"><i class="fa fa-server me-2"></i>Mainboard</a>
                    </li>
                    <li><a href="{{ route('admin.gpu.index') }}"><i class="fa fa-video me-2"></i>GPU</a></li>
                    <li><a href="{{ route('admin.ram.index') }}"><i class="fa fa-memory me-2"></i>RAM</a></li>
                    <li><a href="{{ route('admin.ocung.index') }}"><i class="fa fa-hdd me-2"></i>Ổ cứng</a></li>
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
                    <li><a href="{{ route('admin.thuonghieu.index') }}"><i class="fa fa-star me-2"></i>Thương hiệu</a>
                    </li>
                    <li><a href="{{ route('admin.magiamgia.index') }}"><i class="fa fa-gift me-2"></i>Mã giảm giá</a>
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
                    <li><a href="{{ route('admin.phuongthucthanhtoan.index') }}"><i
                                class="fa fa-credit-card me-2"></i>Phương thức thanh toán</a></li>
                </ul>
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