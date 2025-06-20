<div class="header-top">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <i class="fa-solid fa-gift me-2"></i>MUA PC GVN x MSI TẶNG MÀN OLED 240HZ
        </div>
        <div>
            <span><i class="fa-solid fa-phone me-1"></i>Hotline: 1900.5301</span>
            <span><i class="fa-solid fa-location-dot me-1"></i>Hệ thống Showroom</span>
            <span><i class="fa-solid fa-box me-1"></i>Đơn hàng</span>
            <span><i class="fa-solid fa-user me-1"></i>Đăng nhập</span>
        </div>
    </div>
</div>
<div class="header-main">
    <div class="container d-flex align-items-center">
        <a href="/" class="logo-link" title="Về trang chủ TopPC">
            <svg width="180" height="60" viewBox="0 0 180 60" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="whiteGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#f8fafc;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="redAccent" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#fecaca;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#fee2e2;stop-opacity:1" />
                    </linearGradient>
                </defs>

                <!-- Computer Icon Design -->
                <g transform="translate(5, 5)">
                    <!-- Monitor Screen -->
                    <rect x="5" y="8" width="30" height="20" rx="2" fill="white" />
                    <rect x="7" y="10" width="26" height="16" rx="1" fill="#dc2626" opacity="0.1" />
                    <rect x="9" y="12" width="22" height="10" rx="1" fill="#ef4444" opacity="0.3" />

                    <!-- Monitor Stand -->
                    <rect x="17" y="28" width="6" height="8" rx="1" fill="white" />
                    <rect x="12" y="36" width="16" height="3" rx="1.5" fill="white" />

                    <!-- Screen Details -->
                    <circle cx="20" cy="30" r="1" fill="white" />

                    <!-- Power Indicator -->
                    <circle cx="32" cy="12" r="1.5" fill="#10b981" />

                    <!-- Screen Glow -->
                    <rect x="9" y="12" width="22" height="10" rx="1" fill="none" stroke="white" stroke-width="0.5"
                        opacity="0.4" />

                    <!-- Keyboard (simplified) -->
                    <rect x="8" y="42" width="24" height="6" rx="2" fill="white" opacity="0.8" />
                    <rect x="10" y="44" width="20" height="2" rx="1" fill="#dc2626" opacity="0.2" />
                </g>

                <!-- TopPC Text -->
                <g transform="translate(55, 15)">
                    <!-- TOP text -->
                    <text x="0" y="20" font-family="Arial, sans-serif" font-size="24" font-weight="900" fill="white"
                        letter-spacing="1px">TOP</text>

                    <!-- PC text -->
                    <text x="55" y="20" font-family="Arial, sans-serif" font-size="24" font-weight="900" fill="white"
                        letter-spacing="1px">PC</text>

                    <!-- Tagline -->
                    <text x="0" y="35" font-family="Arial, sans-serif" font-size="8" fill="white" opacity="0.9"
                        letter-spacing="2px">TOPPC.COM</text>
                </g>

                <!-- Additional geometric elements -->
                <g transform="translate(150, 20)">
                    <rect x="0" y="0" width="3" height="20" fill="white" opacity="0.3" />
                    <rect x="5" y="5" width="3" height="15" fill="white" opacity="0.5" />
                    <rect x="10" y="8" width="3" height="12" fill="white" opacity="0.7" />
                </g>
            </svg>
        </a>
        {{-- DROPDOWN DANH MỤC TỪ DATABASE --}}
        <div class="dropdown me-3">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-bars me-2"></i><span class="d-none d-lg-inline">Danh mục</span>
            </button>
            <ul class="dropdown-menu menu-dropdown">
                @foreach ($danhmucs as $danhmuc)
                    <li>
                        <a class="dropdown-item" href="{{ route('danhmuc.show', $danhmuc->id) }}">
                            <i class="fa-solid fa-bars me-2"></i>{{ $danhmuc->ten }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- ----------------------------------------- -->
        <form class="input-group me-2" style="max-width: 400px;">
            <input class="form-control" type="search" placeholder="Bạn cần tìm gì?">
            <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass"></i></span>
            <button type="submit" class="btn btn-danger d-block d-md-none"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <div class="ms-auto d-flex align-items-center">
            <span><i class="fa-solid fa-screwdriver-wrench me-1"></i>Dịch vụ kỹ thuật tại nhà</span>
            <span><i class="fa-solid fa-credit-card me-1"></i>Trả góp</span>

            @auth
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none me-3">
                    <span><i class="fa-solid fa-user me-1"></i>{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-white text-decoration-none p-0 border-0 me-3">
                        <span><i class="fa-solid fa-right-from-bracket me-1"></i>Đăng xuất</span>
                    </button>
                </form>
            @else
                <a href="{{ route('form') }}" class="text-white text-decoration-none me-3">
                    <span><i class="fa-solid fa-user me-1"></i>Đăng nhập</span>
                </a>
            @endauth

            <a class="giohang text-white" href="{{ route('giohang.index') }}">
                <span><i class="fa-solid fa-cart-shopping me-1"></i>Giỏ hàng</span>
            </a>
        </div>
    </div>
</div>
