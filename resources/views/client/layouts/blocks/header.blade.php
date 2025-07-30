<nav class="navbar navbar-expand-lg navbar-dark bg-danger py-2">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand mx-auto d-lg-flex align-items-center" href="/">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="TopPC Logo" class="img-fluid" style="max-height: 60px;">
        </a>

        {{-- Toggle button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nội dung --}}
        <div class="collapse navbar-collapse flex-column flex-lg-row align-items-center text-center" id="navbarContent">
            {{-- Danh mục --}}
            <ul class="navbar-nav ms-lg-4 me-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownDanhMuc" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars me-1"></i>Danh mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownDanhMuc">
                        @foreach ($danhmucs as $danhmuc)
                            <li>
                                <a class="dropdown-item" href="{{ route('danhmuc.index', $danhmuc->id) }}">
                                    {{ $danhmuc->ten }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            {{-- Tìm kiếm --}}
            <form class="d-flex flex-grow-1 me-lg-3 search-form" action="{{ route('searcher.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Bạn cần tìm gì?">
                <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            {{-- Tài khoản + Giỏ hàng --}}
            <ul class="navbar-nav d-flex align-items-center ms-lg-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user me-1"></i>{{ Auth::user()->ho_ten ?? Auth::user()->ten_dang_nhap }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('client.profile.show') }}"><i class="fa-solid fa-id-card me-2"></i>Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item" href="{{ route('client.orders.index') }}"><i class="fa-solid fa-box-open me-2"></i>Đơn hàng của tôi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</button>
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
                        <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 0.7em;">
                            {{ $tongSoLuongGioHang ?? 0 }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
