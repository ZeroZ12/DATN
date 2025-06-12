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
<style>
</style>
<div class="header-main">
    <div class="container d-flex align-items-center">
        <a href="home.blade.php"> <svg width="220" height="44" viewBox="0 0 220 44" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <!-- PC Icon sát chữ, cân đối -->
                <g>
                    <polygon points="4,6 28,1 28,33 4,39" fill="#fff" />
                    <rect x="9" y="10" width="13" height="4" fill="#fff" />
                    <circle cx="12" cy="29" r="2" fill="#fff" />
                    <!-- Monitor -->
                    <rect x="32" y="7" width="22" height="16" stroke="#fff" stroke-width="2" fill="none" />
                    <rect x="40" y="25" width="8" height="2.5" fill="#fff" />
                    <ellipse cx="45" cy="23" rx="6" ry="1.2" fill="#fff" />
                    <!-- Base/Shadow -->
                    <polygon points="36,27 54,27 52,31 34,31" fill="#fff" />
                </g>
                <!-- Text TOP (xám đậm, sát icon) -->
                <text x="62" y="32" font-family="Montserrat, Arial Black, Arial, sans-serif" font-weight="bold"
                    font-size="28" fill="#fff">TOP</text>
                <!-- Nền cam bo góc cho PC -->
                <rect x="130" y="8" width="60" height="28" rx="7" fill="#ff6600" />
                <!-- Text PC trắng, căn giữa nền cam -->
                <text x="140" y="32" font-family="Montserrat, Arial Black, Arial, sans-serif" font-weight="bold"
                    font-size="28" fill="#fff">PC</text>
            </svg></a>

        <div class="dropdown me-3">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-bars me-2"></i><span class="d-none d-lg-inline">Danh mục</span>
            </button>
            <ul class="dropdown-menu menu-dropdown">
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-laptop me-2"></i>Laptop Gaming</a>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-desktop me-2"></i>PC Gaming</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-display me-2"></i>Màn hình</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-mouse me-2"></i>Chuột - Bàn phím</a>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-headphones me-2"></i>Tai nghe</a>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-plug me-2"></i>Phụ kiện</a></li>
            </ul>
        </div>
        <form class="input-group me-2 mt-3" style="max-width: 400px;">
            <input class="form-control" type="search" placeholder="Bạn cần tìm gì?">
            <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass"></i></span>
            <button type="submit" class="btn btn-danger d-block d-md-none"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <div class="ms-auto d-flex align-items-center">
            <span><i class="fa-solid fa-screwdriver-wrench me-1"></i>Dịch vụ kỹ thuật tại nhà</span>
            <span><i class="fa-solid fa-credit-card me-1"></i>Trả góp</span>
            @guest
                <a href="{{ route('login') }}" class="text-white text-decoration-none me-3">
                    <span><i class="fa-solid fa-user me-1"></i>Đăng nhập</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none me-3">
                    <span><i class="fa-solid fa-user me-1"></i>{{ Auth::user()->name }}</span>
                </a>
            @endguest

            <a class="giohang text-white" href="/giohang.html"><span><i
                        class=" fa-solid fa-cart-shopping me-1"></i></i>Giỏ hàng</span></a>
        </div>
    </div>
</div>
<div class="banner">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-12">
                <img src="https://file.hstatic.net/200000722513/file/banner_1920x420_132deaa451444c268495aedb72728389.jpg"
                    class="img-fluid rounded" alt="Banner 1">
            </div>

        </div>
    </div>
</div>
