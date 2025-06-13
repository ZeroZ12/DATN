<div class="overlay"></div>
<aside class="page-sidebar" data-sidebar-layout="stroke-svg">
  <div class="left-arrow" id="left-arrow">
    <svg class="feather">
      <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left"></use>
    </svg>
  </div>
  <div id="sidebar-menu">
    <ul class="sidebar-menu" id="simple-bar">
      <li class="pin-title sidebar-list p-0">

      </li>
      <li class="line pin-line"></li>



<li class="sidebar-list">
  <svg class="pinned-icon">
    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
  </svg>
  <a class="sidebar-link" href="javascript:void(0)">
    <svg class="stroke-icon">
      <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
    </svg>
    Quản lý chung
    <svg class="feather">
      <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
    </svg>
  </a>
  <ul class="sidebar-submenu" style="display: none;">
    <li><a href="{{ route('admin.sanpham.index') }}">Sản phẩm</a></li>
    <li><a href="{{ route('admin.danhmuc.index') }}">Danh mục</a></li>
    <li><a href="{{ route('admin.users.index') }}">Người dùng</a></li>
  </ul>
</li>


<li class="sidebar-list">
  <svg class="pinned-icon">
    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
  </svg>
  <a class="sidebar-link" href="javascript:void(0)">
    <svg class="stroke-icon">
      <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Setting"></use>
    </svg>
    Quản lý phần cứng
    <svg class="feather">
      <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
    </svg>
  </a>
  <ul class="sidebar-submenu" style="display: none;">
    <li><a href="{{ route('admin.chip.index') }}">Chip</a></li>
    <li><a href="{{ route('admin.mainboard.index') }}">Mainboard</a></li>
    <li><a href="{{ route('admin.gpu.index') }}">GPU</a></li>
    <li><a href="{{ route('admin.ram.index') }}">RAM</a></li>
    <li><a href="{{ route('admin.ocung.index') }}">Ổ cứng</a></li>
  </ul>
</li>


      <li class="sidebar-list">
        <svg class="pinned-icon">
          <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
        </svg>
        <a class="sidebar-link" href="javascript:void(0)">
          <svg class="stroke-icon">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Discount"></use>
          </svg>
          Thương hiệu & KM
          <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
          </svg>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('admin.thuonghieu.index') }}">Thương hiệu</a></li>
          <li><a href="{{ route('admin.magiamgia.index') }}">Mã giảm giá</a></li>
        </ul>
      </li>


      <li class="sidebar-list">
        <svg class="pinned-icon">
          <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
        </svg>
        <a class="sidebar-link" href="javascript:void(0)">
          <svg class="stroke-icon">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
          </svg>
          Thanh toán
          <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
          </svg>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('admin.phuongthucthanhtoan.index') }}">Phương thức thanh toán</a></li>
        </ul>
      </li>

      <li class="line"></li>
    </ul>
  </div>
</aside>
