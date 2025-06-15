// script.js - Custom JS for GearVN clone

document.addEventListener('DOMContentLoaded', function() {
  // Dropdown menu (Bootstrap handles this if included)

  // Chatbox close button
  const chatboxClose = document.querySelector('.chatbox-header .fa-xmark');
  const chatbox = document.querySelector('.chatbox');
  if (chatboxClose && chatbox) {
    chatboxClose.addEventListener('click', function() {
      chatbox.classList.remove('active');
    });
  }

  const supportBtn = document.getElementById('support-btn');
  if (supportBtn && chatbox) {
    supportBtn.addEventListener('click', function() {
      chatbox.classList.toggle('active');
    });
  }

  // Modal đăng nhập
  const quickLoginModal = document.getElementById('quick-login-modal');
  const loginFormModal = document.getElementById('login-form-modal');
  const openQuickLoginBtn = document.querySelector('.header-top span:last-child, .header-main .ms-auto span:last-child');
  const closeQuickLoginBtn = document.getElementById('closeQuickLogin');
  const openLoginFormBtn = document.getElementById('openLoginForm');
  const openRegisterFormBtn = document.getElementById('openRegisterForm');
  const closeLoginFormBtn = document.getElementById('closeLoginForm');
  const switchToRegister = document.getElementById('switchToRegister');
  const switchToLogin = document.getElementById('switchToLogin');
  const formLogin = document.getElementById('form-login');
  const formRegister = document.getElementById('form-register');
  const loginFormTitle = document.getElementById('loginFormTitle');

  if (openQuickLoginBtn && quickLoginModal) {
    openQuickLoginBtn.addEventListener('click', function() {
      quickLoginModal.classList.add('active');
    });
  }
  if (closeQuickLoginBtn && quickLoginModal) {
    closeQuickLoginBtn.addEventListener('click', function() {
      quickLoginModal.classList.remove('active');
    });
  }
  if (openLoginFormBtn && loginFormModal && quickLoginModal) {
    openLoginFormBtn.addEventListener('click', function() {
      quickLoginModal.classList.remove('active');
      loginFormModal.classList.add('active');
      if(formLogin && formRegister && loginFormTitle) {
        formLogin.style.display = '';
        formRegister.style.display = 'none';
        loginFormTitle.textContent = 'ĐĂNG NHẬP HOẶC TẠO TÀI KHOẢN';
      }
    });
  }
  if (openRegisterFormBtn && loginFormModal && quickLoginModal) {
    openRegisterFormBtn.addEventListener('click', function() {
      quickLoginModal.classList.remove('active');
      loginFormModal.classList.add('active');
      if(formLogin && formRegister && loginFormTitle) {
        formLogin.style.display = 'none';
        formRegister.style.display = '';
        loginFormTitle.textContent = 'ĐĂNG KÝ TÀI KHOẢN GEARVN';
      }
    });
  }
  if (closeLoginFormBtn && loginFormModal) {
    closeLoginFormBtn.addEventListener('click', function() {
      loginFormModal.classList.remove('active');
    });
  }
  if (switchToRegister && formLogin && formRegister && loginFormTitle) {
    switchToRegister.addEventListener('click', function(e) {
      e.preventDefault();
      formLogin.style.display = 'none';
      formRegister.style.display = '';
      loginFormTitle.textContent = 'ĐĂNG KÝ TÀI KHOẢN GEARVN';
    });
  }
  if (switchToLogin && formLogin && formRegister && loginFormTitle) {
    switchToLogin.addEventListener('click', function(e) {
      e.preventDefault();
      formLogin.style.display = '';
      formRegister.style.display = 'none';
      loginFormTitle.textContent = 'ĐĂNG NHẬP HOẶC TẠO TÀI KHOẢN';
    });
  }
  // Đóng modal khi click overlay
  document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function() {
      quickLoginModal && quickLoginModal.classList.remove('active');
      loginFormModal && loginFormModal.classList.remove('active');
    });
  });

  // Product gallery functionality
  const mainImage = document.querySelector('.product-gallery-main img');
  const thumbnails = document.querySelectorAll('.product-gallery-thumb img');

  thumbnails.forEach(thumb => {
    thumb.addEventListener('click', function() {
      // Remove active class from all thumbnails
      thumbnails.forEach(t => t.classList.remove('active'));
      // Add active class to clicked thumbnail
      this.classList.add('active');
      // Update main image source
      mainImage.src = this.src;
    });
  });

  // User dropdown logic
  document.querySelectorAll('.user-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      e.stopPropagation();
      const dropdown = this.closest('.user-dropdown');
      dropdown.classList.toggle('open');
      // Đóng các dropdown khác
      document.querySelectorAll('.user-dropdown').forEach(function(dd) {
        if(dd !== dropdown) dd.classList.remove('open');
      });
    });
  });
  // Click ra ngoài thì ẩn dropdown
  document.addEventListener('click', function() {
    document.querySelectorAll('.user-dropdown').forEach(function(dd) {
      dd.classList.remove('open');
    });
  });
  // Click vào tên user thì sang thongtincanhan.html
  document.querySelectorAll('.user-menu-name').forEach(function(name) {
    name.addEventListener('click', function(e) {
      window.location.href = 'thongtincanhan.html';
    });
  });

  // Cart quantity logic
  document.querySelectorAll('.cart-item-qty').forEach(function(qtyBox) {
    const minusBtn = qtyBox.querySelector('button.cart-qty-btn:first-child');
    const plusBtn = qtyBox.querySelector('button.cart-qty-btn:last-child');
    const input = qtyBox.querySelector('.cart-qty-input');
    minusBtn.addEventListener('click', function() {
      let val = parseInt(input.value);
      if(val > 1) input.value = val - 1;
      updateCartTotal();
    });
    plusBtn.addEventListener('click', function() {
      let val = parseInt(input.value);
      input.value = val + 1;
      updateCartTotal();
    });
  });
  function updateCartTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(function(item) {
      const priceText = item.querySelector('.cart-item-price').textContent.replace(/[^\d]/g, '');
      const qty = parseInt(item.querySelector('.cart-qty-input').value);
      total += parseInt(priceText) * qty;
    });
    document.querySelector('.cart-total').textContent = 'Tổng tiền: ' + total.toLocaleString('vi-VN') + '₫';
  }
  updateCartTotal();

  // Giỏ hàng toàn cục với localStorage và badge
  function getCart() {
    return JSON.parse(localStorage.getItem('cart') || '[]');
  }
  function setCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
  }
  function updateCartBadge() {
    const cart = getCart();
    let totalQty = 0;
    cart.forEach(item => totalQty += item.qty);
    let badge = document.querySelector('.cart-badge');
    if (!badge) {
      const cartIcon = document.querySelector('.fa-cart-shopping');
      if(cartIcon) {
        badge = document.createElement('span');
        badge.className = 'cart-badge';
        cartIcon.parentNode.appendChild(badge);
      }
    }
    if(badge) badge.textContent = totalQty > 0 ? totalQty : '';
  }
  // Gọi khi load trang
  updateCartBadge();

  // Thêm vào giỏ hàng ở trang chi tiết sản phẩm
  window.addToCart = function(product) {
    let cart = getCart();
    let found = cart.find(item => item.id === product.id);
    if(found) found.qty += product.qty;
    else cart.push(product);
    setCart(cart);
    updateCartBadge();
  }
  // Gắn vào nút MUA NGAY ở trang chi tiết sản phẩm:
  // <button onclick="addToCart({id: 'pc-13400f', name: 'PC GVN Intel i5-13400F/ VGA RTX 5060', price: 23990000, qty: 1, img: '...url...'})">MUA NGAY</button>

  // Ở trang giỏ hàng: render từ localStorage, tăng/giảm số lượng cập nhật localStorage và badge
  if(document.querySelector('.cart-box')) {
    function renderCart() {
      const cart = getCart();
      const cartBox = document.querySelector('.cart-box');
      const items = cart.map(item => `
        <div class="cart-item">
          <img src="${item.img}" alt="${item.name}">
          <div class="flex-grow-1">
            <div class="cart-item-title">${item.name}</div>
            <div class="cart-item-qty mt-2">
              <button class="cart-qty-btn" type="button">-</button>
              <input type="text" class="cart-qty-input" value="${item.qty}" min="1" style="width:40px; text-align:center;" readonly>
              <button class="cart-qty-btn" type="button">+</button>
              <span class="cart-item-remove">Xoá</span>
            </div>
          </div>
          <div class="text-end">
            <div class="cart-item-price">${item.price.toLocaleString('vi-VN')}₫</div>
          </div>
        </div>`).join('');
      cartBox.querySelectorAll('.cart-item').forEach(e => e.remove());
      cartBox.insertAdjacentHTML('afterbegin', items);
      updateCartTotal();
      updateCartBadge();
      bindCartEvents();
    }
    function bindCartEvents() {
      document.querySelectorAll('.cart-item-qty').forEach(function(qtyBox, idx) {
        const minusBtn = qtyBox.querySelector('button.cart-qty-btn:first-child');
        const plusBtn = qtyBox.querySelector('button.cart-qty-btn:last-child');
        const input = qtyBox.querySelector('.cart-qty-input');
        minusBtn.onclick = function() {
          let cart = getCart();
          if(cart[idx].qty > 1) cart[idx].qty--;
          setCart(cart); renderCart();
        };
        plusBtn.onclick = function() {
          let cart = getCart();
          cart[idx].qty++;
          setCart(cart); renderCart();
        };
      });
      document.querySelectorAll('.cart-item-remove').forEach(function(btn, idx) {
        btn.onclick = function() {
          let cart = getCart();
          cart.splice(idx, 1);
          setCart(cart); renderCart();
        };
      });
    }
    function updateCartTotal() {
      let total = 0;
      getCart().forEach(item => total += item.price * item.qty);
      const totalDiv = document.querySelector('.cart-total');
      if(totalDiv) totalDiv.textContent = 'Tổng tiền: ' + total.toLocaleString('vi-VN') + '₫';
    }
    renderCart();
  }
}); 