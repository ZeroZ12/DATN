<nav class="navbar navbar-expand-lg navbar-dark bg-danger py-2">
    <div class="container">
        {{-- Header mobile: Dòng 1 --}}
        <div class="d-flex align-items-center justify-content-between d-lg-none w-100">
            {{-- Nút toggle menu --}}
            <button class="col-2 btn text-white p-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-4"></i>
            </button>

            {{-- Logo --}}
            <a class="col-6 navbar-brand p-0" href="/">
                <img src="{{ asset('storage/logo/logo.png') }}"
                     alt="TopPC Logo" class="img-fluid logo-mobile" style="max-height: 40px;">
            </a>

            {{-- Tài khoản --}}
            @auth
                <a class="col-2 text-white px-2" href="{{ route('client.profile.show') }}">
                    <i class="fa-solid fa-user fs-5"></i>
                </a>
            @else
                <a class="col-2 text-white px-2" href="{{ route('form') }}">
                    <i class="fa-solid fa-user fs-5"></i>
                </a>
            @endauth

            {{-- Giỏ hàng --}}
<a class="col-2 text-white px-2" href="{{ route('client.cart.index') }}">
    <span class="position-relative">
        <i class="fa-solid fa-cart-shopping fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 0.7em;">
            {{ $tongSoLuongGioHang ?? 0 }}
        </span>
    </span>
</a>
        </div>

        {{-- Header mobile: Dòng 2 – Tìm kiếm --}}
        <div class="d-lg-none w-100 mt-2">
            <form class="d-flex" action="{{ route('searcher.search') }}" method="GET">
                <input class="form-control form-control-sm" type="search" name="keyword"
                       placeholder="Tìm kiếm sản phẩm...">
                <button class="btn btn-light btn-sm ms-2" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        {{-- Danh mục mobile (collapse) --}}
        <div class="collapse w-100 mt-2 d-lg-none" id="mobileMenu">
            <ul class="navbar-nav">
                @foreach ($danhmucs as $danhmuc)
                    <li class="nav-item">
                        <a class="nav-link text-white"
                           href="{{ route('danhmuc.index', $danhmuc->id) }}">
                            {{ $danhmuc->ten }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Desktop full navbar --}}
        <div class="collapse navbar-collapse d-none d-lg-flex flex-row align-items-center w-100"
             id="navbarContent">
            {{-- Logo --}}
            <a class="navbar-brand me-3" href="/">
                <img src="{{ asset('storage/logo/logo.png') }}"
                     alt="TopPC Logo" class="img-fluid" style="max-height: 60px;">
            </a>

            {{-- Danh mục --}}
            <ul class="navbar-nav me-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#"
                       id="navbarDropdownDanhMuc" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa-solid fa-bars me-1"></i>Danh mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownDanhMuc">
                        @foreach ($danhmucs as $danhmuc)
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('danhmuc.index', $danhmuc->id) }}">
                                    {{ $danhmuc->ten }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            {{-- Tìm kiếm --}}
            <form class="d-flex flex-grow-1 me-3" action="{{ route('searcher.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="keyword"
                       placeholder="Bạn cần tìm gì?">
                <button class="btn btn-light" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            {{-- Tài khoản + Giỏ hàng --}}
            <ul class="navbar-nav d-flex align-items-center">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#"
                           id="navbarUser" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa-solid fa-user me-1"></i>
                            {{ Auth::user()->ho_ten ?? Auth::user()->ten_dang_nhap }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('client.profile.show') }}">
                                    <i class="fa-solid fa-id-card me-2"></i>Thông tin tài khoản
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('client.orders.index') }}">
                                    <i class="fa-solid fa-box-open me-2"></i>Đơn hàng của tôi
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->vai_tro === 'quan_tri')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.index') }}">
                                <i class="fa-solid fa-screwdriver-wrench me-1"></i>Admin
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('form') }}">
                            <i class="fa-solid fa-user me-1"></i>Đăng nhập
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link text-white position-relative" href="{{ route('client.cart.index') }}">
                        <i class="fa-solid fa-cart-shopping me-1"></i>Giỏ hàng
                        <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark"
                              style="font-size: 0.7em;">
                            {{ $tongSoLuongGioHang ?? 0 }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    @media (max-width: 739px) {
        .logo-mobile {
            width: 100%;
            height: 100%;
        }

        .badge {
            top: -5px !important;
            right: -5px !important; /* Thay start-100 bằng right */
            transform: translate(0, 0) !important;
            font-size: 0.6em !important;
        }
    }
</style>