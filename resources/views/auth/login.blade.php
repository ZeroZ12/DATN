@php
    // Đảm bảo không dùng layout mặc định của Laravel để tránh Tailwind CSS ghi đè
    $registerFields = ['ten_dang_nhap', 'ho_ten', 'so_dien_thoai', 'password', 'password_confirmation'];
    $isRegisterError = false;
    foreach($registerFields as $field) {
        if ($errors->has($field)) {
            $isRegisterError = true;
            break;
        }
    }
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GEARVN - Đăng nhập/Đăng ký</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/font/user/style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
  <style>
body {
  background: #f2f2f2;
  font-family: 'Roboto', Arial, sans-serif;
  color: #222;
}

.header-top {
  background: #002147;
  color: #fff;
  font-size: 15px;
  padding: 6px 0;
}
.header-top a, .header-top span {
  color: #fff;
  text-decoration: none;
  margin-right: 18px;
  transition: color 0.2s;
}
.header-top a:hover {
  color: #ffb400;
}

.header-main {
  background: #e60023;
  color: #fff;
  padding: 12px 0;
  font-size: 16px;
}
.header-main img {
  height: 40px;
}
.header-main .dropdown-toggle {
  background: #fff;
  color: #222;
  border-radius: 6px;
  font-weight: 500;
}
.header-main .dropdown-menu {
  min-width: 220px;
  border-radius: 8px;
  box-shadow: 0 2px 8px #0002;
}
.header-main .form-control {
  border-radius: 6px;
  border: none;
  box-shadow: none;
}
.header-main .btn-light {
  background: #fff;
  color: #e60023;
  border-radius: 6px;
  border: none;
}
.header-main .btn-light:hover {
  background: #ffebee;
}
.header-main .ms-auto span {
  margin-right: 18px;
  cursor: pointer;
  font-weight: 500;
}
.header-main .ms-auto span:last-child {
  margin-right: 0;
}

.banner {
  background: #fff;
  padding: 20px 0 10px 0;
  border-radius: 8px;
  margin-bottom: 12px;
}
.banner img {
  border-radius: 8px;
  width: 100%;
  object-fit: cover;
}

.filter-bar {
  background: #fff;
  border-radius: 8px;
  padding: 12px 18px;
  margin-bottom: 18px;
  box-shadow: 0 2px 8px #0001;
}
.filter-bar .btn {
  border-radius: 6px;
  border: 1px solid #e0e0e0;
  background: #fff;
  color: #222;
  font-weight: 500;
  transition: background 0.2s, color 0.2s;
}
.filter-bar .btn:hover {
  background: #e60023;
  color: #fff;
}

.product-card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px #0001;
  margin-bottom: 24px;
  padding: 16px 12px 12px 12px;
  position: relative;
  transition: box-shadow 0.2s;
}
.product-card:hover {
  box-shadow: 0 4px 16px #e6002322;
}
.product-card img {
  border-radius: 8px;
  margin-bottom: 8px;
  width: 100%;
  object-fit: contain;
}
.product-card .fw-bold {
  font-size: 16px;
  min-height: 44px;
}
.product-card .text-danger {
  font-size: 18px;
}
.product-card .old-price {
  text-decoration: line-through;
  color: #888;
  font-size: 14px;
  margin-right: 8px;
}
.product-card .discount {
  background: #e60023;
  color: #fff;
  font-size: 12px;
  border-radius: 4px;
  padding: 2px 6px;
  margin-left: 4px;
}
.product-card .badge {
  position: absolute;
  top: 12px;
  left: 12px;
  font-size: 12px;
  font-weight: 600;
  border-radius: 4px;
  padding: 2px 8px;
  z-index: 2;
}
.product-card .badge-hot {
  background: #ffb400;
  color: #222;
}
.product-card .badge-sale {
  background: #e60023;
  color: #fff;
}
.product-card .badge-gift {
  background: #00b894;
  color: #fff;
}
.product-card .rating {
  color: #ffb400;
  font-size: 14px;
}
.product-card .gift-icon {
  color: #e60023;
  margin-right: 2px;
}

.footer {
  background: #222;
  color: #fff;
  padding: 32px 0 16px 0;
  font-size: 15px;
}
.footer h6 {
  color: #ffb400;
  font-size: 16px;
  margin-bottom: 12px;
}
.footer ul {
  padding-left: 0;
  list-style: none;
}
.footer li {
  margin-bottom: 6px;
}
.footer .text-center {
  margin-top: 18px;
  font-size: 16px;
}
.footer .social-icons i {
  font-size: 22px;
  margin: 0 8px;
  color: #fff;
  transition: color 0.2s;
}
.footer .social-icons i:hover {
  color: #ffb400;
}

.chatbox {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 320px;
  z-index: 9999;
  background: #fff;
  box-shadow: 0 4px 24px #0002;
  border-radius: 12px;
  padding: 0;
  overflow: hidden;
  display: none; /* Ẩn chatbox mặc định */
}
.chatbox.active {
  display: block;
}
.chatbox-header {
  background: #e60023;
  color: #fff;
  padding: 10px 16px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.chatbox-header .fa-xmark {
  cursor: pointer;
  font-size: 18px;
}
.chatbox-body {
  padding: 14px 16px;
  font-size: 14px;
  color: #222;
  height: 120px;
  overflow-y: auto;
  background: #fff;
}
.chatbox-input {
  border-top: 1px solid #eee;
  padding: 10px 16px;
  background: #fafafa;
}
.chatbox-input input {
  width: 100%;
  border-radius: 6px;
  border: 1px solid #ddd;
  padding: 6px 10px;
  font-size: 14px;
}

.support-btn {
  position: fixed;
  bottom: 24px;
  right: 24px;
  width: 56px;
  height: 56px;
  background: #e60023;
  color: #fff;
  border-radius: 50%;
  box-shadow: 0 4px 16px #0002;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  cursor: pointer;
  z-index: 10000;
  transition: background 0.2s;
}
.support-btn:hover {
  background: #b8001b;
}

@media (max-width: 991px) {
  .row-cols-md-4 > * {
    flex: 0 0 50%;
    max-width: 50%;
  }
  .chatbox {
    width: 95vw;
    right: 2vw;
  }
  .header-main .container {
    flex-wrap: wrap;
    gap: 8px;
    justify-content: flex-start;
  }
  .header-main .dropdown {
    margin-right: 8px !important;
  }
  .header-main .input-group {
    max-width: 60vw !important;
    min-width: 120px;
    flex: 1 1 120px;
  }
  .header-main .ms-auto {
    flex-basis: 100%;
    margin-top: 8px;
    justify-content: flex-start !important;
  }
}
@media (max-width: 575px) {
  .row-cols-md-4 > * {
    flex: 0 0 100%;
    max-width: 100%;
  }
  .header-main, .header-top, .footer {
    font-size: 13px;
  }
  .header-main .container {
    flex-direction: column;
    align-items: stretch;
    gap: 6px;
  }
  .header-main .input-group {
    max-width: 100% !important;
  }
  .header-main .ms-auto {
    margin-top: 6px;
    font-size: 13px;
  }
}

.viewed-products .product-card img {
  height: 80px;
  width: auto;
  object-fit: contain;
  border-radius: 8px;
  margin-bottom: 8px;
}

/* Modal custom */
.modal-custom {
  display: none;
  position: fixed;
  z-index: 20000;
  left: 0; top: 0; right: 0; bottom: 0;
  width: 100vw; height: 100vh;
  align-items: center;
  justify-content: center;
}
.modal-custom.active {
  display: flex;
}
.modal-overlay {
  position: absolute;
  left: 0; top: 0; right: 0; bottom: 0;
  width: 100vw; height: 100vh;
  background: rgba(0,0,0,0.35);
  z-index: 1;
}
.modal-content {
  position: relative;
  z-index: 2;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 32px #0003;
  padding: 32px 24px 24px 24px;
  min-width: 320px;
  max-width: 95vw;
  animation: fadeInModal 0.2s;
}
.giohang
{
  text-decoration: none;
}
        /* Chi tiet san pham */
        .product-gallery-thumb img {
          border: 2px solid #eee;
          border-radius: 6px;
          cursor: pointer;
          margin-right: 6px;
          width: 60px;
          height: 60px;
          object-fit: cover;
        }

        .product-gallery-thumb img.active {
          border: 2px solid #e60023;
        }

        .product-gallery-main img {
          border-radius: 8px;
          width: 100%;
          max-width: 350px;
        }

        .product-info-box {
          background: #fff;
          border-radius: 8px;
          box-shadow: 0 2px 8px #0001;
          padding: 24px;
        }

        .product-price {
          font-size: 28px;
          color: #e60023;
          font-weight: bold;
        }

        .product-old-price {
          text-decoration: line-through;
          color: #888;
          font-size: 18px;
          margin-left: 8px;
        }

        .product-discount {
          background: #e60023;
          color: #fff;
          font-size: 14px;
          border-radius: 4px;
          padding: 2px 8px;
          margin-left: 8px;
        }

        .product-rating i {
          color: #ffb400;
          font-size: 18px;
        }

        .product-rating .fa-regular {
          color: #ccc;
        }

        .product-buy-btn {
          font-size: 18px;
          padding: 12px 32px;
          border-radius: 8px;
        }

        .product-promo {
          background: #fff8e1;
          border-radius: 6px;
          padding: 12px;
          margin-bottom: 12px;
          font-size: 15px;
        }

        .showroom-list {
          font-size: 15px;
        }

        .showroom-list i {
          color: #e60023;
          margin-right: 4px;
        }

        .similar-products .product-card {
          min-width: 220px;
        }

        .radar-chart-box {
          background: #fff;
          border-radius: 8px;
          box-shadow: 0 2px 8px #0001;
          padding: 18px;
        }

        .product-config-box {
          background: #fff;
          border-radius: 8px;
          box-shadow: 0 2px 8px #0001;
          padding: 18px;
        }

        .news-list {
          font-size: 15px;
        }

        .news-list li {
          margin-bottom: 8px;
        }

        .viewed-products .product-card {
          min-width: 220px;
        }

        .breadcrumb {
          background: none;
          font-size: 15px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
          content: ">";
          color: #888;
        }
@keyframes fadeInModal {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
.modal-content .login-choice-row {
  display: flex;
  gap: 10px;
  margin-bottom: 12px;
}
.modal-content .login-choice-row .btn {
  flex: 1 1 0;
  min-width: 0;
  font-size: 16px;
  padding: 8px 0;
}
@media (max-width: 575px) {
  .modal-content {
    min-width: 90vw;
    max-width: 98vw;
    padding: 18px 8px 16px 8px;
  }
  .modal-content .login-choice-row .btn {
    font-size: 15px;
    padding: 8px 0;
  }
}

.modal-custom#quick-login-modal .modal-content {
  max-width: 400px;
  width: 100%;
  min-width: 0;
  margin: 0 auto;
}
@media (max-width: 575px) {
  .modal-custom#quick-login-modal .modal-content {
    max-width: 95vw;
    width: 95vw;
  }
}


/* User Dropdown */
.user-dropdown {
  cursor: pointer;
}
.user-toggle {
  color: #fff;
  font-weight: 500;
  padding: 6px 12px;
  border-radius: 6px;
  transition: background 0.2s;
  display: flex;
  align-items: center;
}
.user-toggle:hover, .user-dropdown.open .user-toggle {
  background: #ffebee;
  color: #e60023;
}
.user-menu {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 16px #0002;
  min-width: 220px;
  overflow: hidden;
  display: none;
}
.user-dropdown.open .user-menu {
  display: block !important;
}
.user-menu-item {
  color: #222;
  font-size: 15px;
  transition: background 0.2s, color 0.2s;
}
.user-menu-item:hover {
  background: #f8f9fa;
  color: #e60023;
}
.user-menu-name {
  border-bottom: 1px solid #eee;
  color: #e60023;
  font-size: 16px;
}


  </style>
</head>
<body>
  <!-- Header Top -->
  <div class="header-top">
    <div class="container d-flex justify-content-between align-items-center">
      <div>
        <i class="fa-solid fa-gift me-2"></i>MUA PC GVN x MSI TẶNG MÀN OLED 240HZ
      </div>
      <div>
        <span><i class="fa-solid fa-phone me-1"></i>Hotline: 1900.5301</span>
        <span><i class="fa-solid fa-location-dot me-1"></i>Hệ thống Showroom</span>
        <span><i class="fa-solid fa-box me-1"></i>Đơn hàng</span>
      </div>
    </div>
  </div>

  <!-- Header Main -->
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
                    <rect x="9" y="12" width="22" height="10" rx="1" fill="none" stroke="white"
                        stroke-width="0.5" opacity="0.4" />

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
    </div>
  </div>

  <!-- Login/Register Container -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="mb-0" id="formTitle">ĐĂNG NHẬP</h5>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="formSwitch">
                <label class="form-check-label" for="formSwitch">Đăng ký</label>
              </div>
            </div>

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login') }}">
              @csrf
              @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
              @endif
              @if($errors->any())
                <div class="alert alert-danger mb-2">
                  <ul class="mb-0">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" required autofocus>
              </div>
              <div class="mb-3 position-relative">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
                  <i class="fa-regular fa-eye"></i>
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="#" class="small text-decoration-none">Đăng nhập bằng số điện thoại</a>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="small text-decoration-none">Quên mật khẩu?</a>
                @endif
              </div>
              <button type="submit" class="btn btn-danger w-100 mb-4 py-2">ĐĂNG NHẬP</button>
              <div class="text-center mb-3 text-muted">hoặc đăng nhập bằng</div>
              <div class="d-flex gap-2 mb-4">
                <button type="button" class="btn btn-light flex-grow-1 py-2">
                  <i class="fa-brands fa-google text-danger me-2"></i>Google
                </button>
                <button type="button" class="btn btn-light flex-grow-1 py-2">
                  <i class="fa-brands fa-facebook text-primary me-2"></i>Facebook
                </button>
              </div>
            </form>

            <!-- Register Form -->
            <form id="registerForm" method="POST" action="{{ route('register') }}" style="display: none;">
              @csrf
              <div class="mb-3">
                <input type="text" name="ten_dang_nhap" class="form-control form-control-lg" placeholder="Tên đăng nhập" value="{{ old('ten_dang_nhap') }}" required>
                @error('ten_dang_nhap')<div class="text-danger small">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <input type="text" name="ho_ten" class="form-control form-control-lg" placeholder="Họ tên" value="{{ old('ho_ten') }}" required>
                @error('ho_ten')<div class="text-danger small">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <input type="text" name="so_dien_thoai" class="form-control form-control-lg" placeholder="Số điện thoại" value="{{ old('so_dien_thoai') }}" required>
                @error('so_dien_thoai')<div class="text-danger small">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
              </div>
              <div class="mb-4 position-relative">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
                  <i class="fa-regular fa-eye"></i>
                </span>
                @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
              </div>
              <div class="mb-4 position-relative">
                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Xác nhận mật khẩu" required>
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
                  <i class="fa-regular fa-eye"></i>
                </span>
              </div>
              <button type="submit" class="btn btn-danger w-100 mb-4 py-2">TẠO TÀI KHOẢN</button>
              <div class="text-center mb-3 text-muted">hoặc đăng ký bằng</div>
              <div class="d-flex gap-2 mb-4">
                <button type="button" class="btn btn-light flex-grow-1 py-2">
                  <i class="fa-brands fa-google text-danger me-2"></i>Google
                </button>
                <button type="button" class="btn btn-light flex-grow-1 py-2">
                  <i class="fa-brands fa-facebook text-primary me-2"></i>Facebook
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="footer mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h6>Về GEARVN</h6>
          <ul class="list-unstyled">
            <li>Giới thiệu</li>
            <li>Tuyển dụng</li>
            <li>Liên hệ</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Chính sách</h6>
          <ul class="list-unstyled">
            <li>Chính sách bảo hành</li>
            <li>Chính sách đổi trả</li>
            <li>Chính sách bảo mật</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Thông tin</h6>
          <ul class="list-unstyled">
            <li>Hệ thống cửa hàng</li>
            <li>Hướng dẫn mua hàng</li>
            <li>Hướng dẫn thanh toán</li>
            <li>Hướng dẫn trả góp</li>
            <li>Tra cứu địa chỉ bảo hành</li>
            <li>Build PC</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Tổng đài hỗ trợ</h6>
          <ul class="list-unstyled">
            <li>Mua hàng: 1900.5301</li>
            <li>Khiếu nại: 1900.6173</li>
            <li>Email: cskh@gearvn.com</li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-3">
        <span>KẾT NỐI VỚI CHÚNG TÔI</span>
        <div class="social-icons d-inline-block ms-2">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const formType = urlParams.get('type');
    const isRegisterError = {{ $isRegisterError ? 'true' : 'false' }};

    // Get form elements
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const formSwitch = document.getElementById('formSwitch');
    const formTitle = document.getElementById('formTitle');

    // Function to switch between forms
    function switchForm(isRegister) {
      if (isRegister) {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        formTitle.textContent = 'ĐĂNG KÝ TÀI KHOẢN';
        formSwitch.checked = true;
      } else {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        formTitle.textContent = 'ĐĂNG NHẬP';
        formSwitch.checked = false;
      }
    }

    // Initialize form based on URL parameter hoặc lỗi validate
    if (formType === 'register' || isRegisterError) {
      switchForm(true);
    } else {
      switchForm(false);
    }

    // Handle form switch
    formSwitch.addEventListener('change', function() {
      switchForm(this.checked);
    });

    // Toggle password visibility
    document.querySelectorAll('.fa-eye').forEach(icon => {
      icon.addEventListener('click', function() {
        const input = this.parentElement.previousElementSibling;
        if (input.type === 'password') {
          input.type = 'text';
          this.classList.remove('fa-eye');
          this.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          this.classList.remove('fa-eye-slash');
          this.classList.add('fa-eye');
        }
      });
    });
  </script>
</body>
</html>
