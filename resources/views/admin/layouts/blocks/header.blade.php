        <header class="page-header row">
            <div class="logo-wrapper d-flex align-items-center col-auto">
                <a href="{{ route('admin.index') }}">
                 <img src="{{ asset('storage/logo/logo.png') }}" alt="TopPC Logo" class="img-fluid" style="max-height: 70px;">
                </a>
                <a class="close-btn" href="javascript:void(0)">
                    <div class="toggle-sidebar">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </a>
            </div>
            <div class="page-main-header col">
                <div class="header-left d-lg-block d-none">
                    <form class="search-form mb-0">
                        <div class="input-group">
                            <input class="form-control pe-0" type="text" placeholder="Tìm kiếm ...">
                            <span class="input-group-text">
                                <i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                    </form>
                </div>
                <div class="nav-right">
                    <ul class="header-right">
                        {{-- <li class="modes px-3 d-flex"><a class="dark-mode">
                                <i class="fa-solid fa-circle-half-stroke"></i></a></li> --}}
                       
                        <li class="profile-dropdown custom-dropdown">
                            <div class="d-flex align-items-center"><img src="/assets/images/profile.png" alt="">
                                <div class="flex-grow-1">
                                    <h5>{{ Auth::user()->ho_ten ?? Auth::user()->ten_dang_nhap }}</h5>
                                    <span>Quản trị viên</span>
                                </div>
                            </div>
                            <div class="custom-menu overflow-hidden">
                                <ul>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Profile">
                                            </use>
                                        </svg><a class="ms-2" href="user-profile.html">Account</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Message">
                                            </use>
                                        </svg><a class="ms-2" href="letter-box.html">Inbox</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Document">
                                            </use>
                                        </svg><a class="ms-2" href="to-do.html">Task</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Login">
                                            </use>
                                        </svg>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
