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
            <form id="loginForm">
              <div class="mb-3">
                <input type="email" class="form-control form-control-lg" placeholder="Email">
              </div>
              <div class="mb-3 position-relative">
                <input type="password" class="form-control form-control-lg" placeholder="Mật khẩu">
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
                  <i class="fa-regular fa-eye"></i>
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="#" class="small text-decoration-none">Đăng nhập bằng số điện thoại</a>
                <a href="#" class="small text-decoration-none">Quên mật khẩu email?</a>
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
            <form id="registerForm" style="display: none;">
              <div class="mb-3">
                <input type="email" class="form-control form-control-lg" placeholder="Email">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Họ">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Tên">
              </div>
              <div class="mb-4 position-relative">
                <input type="password" class="form-control form-control-lg" placeholder="Mật khẩu">
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