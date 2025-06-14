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

  if (mainImage && thumbnails.length > 0) {
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
  }

  // User dropdown logic
  document.querySelectorAll('.user-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      e.stopPropagation();
      const dropdown = this.closest('.user-dropdown');
      if (dropdown) {
        dropdown.classList.toggle('open');
        document.querySelectorAll('.user-dropdown').forEach(function(dd) {
          if(dd !== dropdown) dd.classList.remove('open');
        });
      }
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

  // Giỏ hàng toàn cục với localStorage và badge
  function getCart() {
    return JSON.parse(localStorage.getItem('cart') || '[]');
  }

  function setCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  function updateCartTotal() {
    const cartTotalElement = document.querySelector('.cart-total');
    if (!cartTotalElement) return; // Exit early if not on cart page

    let total = 0;
    const cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach(function(item) {
      const priceText = item.querySelector('.cart-item-price')?.textContent?.replace(/[^\d]/g, '') || '0';
      const qty = parseInt(item.querySelector('.cart-qty-input')?.value || '0');
      total += parseInt(priceText) * qty;
    });

    cartTotalElement.textContent = 'Tổng tiền: ' + total.toLocaleString('vi-VN') + '₫';
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
    if(badge) {
      badge.textContent = totalQty > 0 ? totalQty : '';
      badge.style.display = totalQty > 0 ? 'inline-block' : 'none'; // Hide if 0
    }
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
        if (minusBtn && plusBtn && input) {
          minusBtn.onclick = function() {
            let cart = getCart();
            if(cart[idx] && cart[idx].qty > 1) cart[idx].qty--;
            setCart(cart); renderCart();
          };
          plusBtn.onclick = function() {
            let cart = getCart();
            if(cart[idx]) cart[idx].qty++;
            setCart(cart); renderCart();
          };
        }
      });
      document.querySelectorAll('.cart-item-remove').forEach(function(btn, idx) {
        btn.onclick = function() {
          let cart = getCart();
          cart.splice(idx, 1);
          setCart(cart); renderCart();
        };
      });
    }
    renderCart();
  }

  // Flash Sale Countdown Timer
  function updateCountdown() {
    const countdownElements = document.querySelectorAll('.countdown-timer .badge');
    if (countdownElements.length === 0) {
      return;
    }

    const now = new Date();
    const endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59);
    const timeLeft = endOfDay - now;

    if (timeLeft < 0) {
      countdownElements[0].textContent = '00';
      countdownElements[1].textContent = '00';
      countdownElements[2].textContent = '00';
      return;
    }

    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    countdownElements[0].textContent = String(hours).padStart(2, '0');
    countdownElements[1].textContent = String(minutes).padStart(2, '0');
    countdownElements[2].textContent = String(seconds).padStart(2, '0');
  }

  const allProducts = {
    'day1': [
      { id: 'fs-pc-1', name: 'PC GVN AMD R5-5600X/ VGA RTX 3060 (Day 1)', oldPrice: '22.990.000₫', newPrice: '19.990.000₫', discount: '-13%', rating: '★★★★☆', reviews: 5, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-pc-2', name: 'PC GVN Intel i5-12400F/ VGA RTX 4060 (Day 1)', oldPrice: '21.990.000₫', newPrice: '18.490.000₫', discount: '-16%', rating: '★★★★★', reviews: 10, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-pc-3', name: 'PC GVN Intel i3-12100F/ VGA RTX 3050 (Day 1)', oldPrice: '13.990.000₫', newPrice: '11.390.000₫', discount: '-19%', rating: '★★★★☆', reviews: 7, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-pc-4', name: 'PC GVN AMD R7-7700/ VGA RTX 3060 (Day 1)', oldPrice: '34.990.000₫', newPrice: '30.490.000₫', discount: '-13%', rating: '★★★★★', reviews: 3, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
    ],
    'day2': [
      { id: 'fs-laptop-1', name: 'Laptop Gaming XYZ (Day 2)', oldPrice: '25.990.000₫', newPrice: '21.990.000₫', discount: '-15%', rating: '★★★★☆', reviews: 8, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-laptop-2', name: 'Laptop Gaming ABC (Day 2)', oldPrice: '23.990.000₫', newPrice: '19.990.000₫', discount: '-17%', rating: '★★★★★', reviews: 12, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-laptop-3', name: 'Laptop Gaming DEF (Day 2)', oldPrice: '20.990.000₫', newPrice: '17.990.000₫', discount: '-14%', rating: '★★★★☆', reviews: 6, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-laptop-4', name: 'Laptop Gaming GHI (Day 2)', oldPrice: '28.990.000₫', newPrice: '24.990.000₫', discount: '-14%', rating: '★★★★★', reviews: 4, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
    ],
    'day3': [
      { id: 'fs-monitor-1', name: 'Màn hình ASUS TUF Gaming (Day 3)', oldPrice: '7.990.000₫', newPrice: '6.500.000₫', discount: '-18%', rating: '★★★★☆', reviews: 9, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-mouse-1', name: 'Chuột Logitech G502 Hero (Day 3)', oldPrice: '1.200.000₫', newPrice: '999.000₫', discount: '-17%', rating: '★★★★★', reviews: 15, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-keyboard-1', name: 'Bàn phím cơ AKKO 3087 (Day 3)', oldPrice: '2.500.000₫', newPrice: '1.990.000₫', discount: '-20%', rating: '★★★★☆', reviews: 11, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
      { id: 'fs-headset-1', name: 'Tai nghe HyperX Cloud Alpha (Day 3)', oldPrice: '2.000.000₫', newPrice: '1.500.000₫', discount: '-25%', rating: '★★★★★', reviews: 10, img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png' },
    ]
  };

  // Flash Sale Countdown Timer & Daily Buttons
  setInterval(updateCountdown, 1000); // Start timer
  updateCountdown(); // Initial call to display immediately

  const flashSaleProductsContainer = document.querySelector('.flash-sale-products');

  function renderFlashSaleProducts(dayKey) {
    const flashSaleProductsContainer = document.querySelector('.flash-sale-products');
    if (!flashSaleProductsContainer) {
      console.error('Flash sale products container not found!');
      return;
    }
    const products = allProducts[dayKey];
    if (!products || products.length === 0) {
      flashSaleProductsContainer.innerHTML = '<p class="text-center w-100">Không có sản phẩm nào cho ngày này.</p>';
      return;
    }

    let productHtml = '';
    products.forEach(product => {
      productHtml += `
        <div class="col">
          <a href="chitietsanpham.html" class="text-decoration-none text-dark">
            <div class="product-card p-3">
              <span class="badge badge-sale"><i class="fa-solid fa-bolt"></i> Flash Sale</span>
              <img src="${product.img}" class="img-fluid mb-2" alt="${product.name}">
              <h6 class="fw-bold">${product.name}</h6>
              <div class="mb-2">
                <span class="old-price">${product.oldPrice}</span>
                <span class="text-danger fw-bold">${product.newPrice}</span>
                <span class="discount">${product.discount}</span>
              </div>
              <div class="small text-muted">
                <span class="rating">${product.rating}</span> (${product.reviews})
              </div>
            </div>
          </a>
        </div>
      `;
    });
    flashSaleProductsContainer.innerHTML = productHtml;
  }

  const dailyButtons = document.querySelectorAll('.flash-sale-days .btn');
  dailyButtons.forEach(button => {
    button.addEventListener('click', function() {
      dailyButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      const dayIndex = this.textContent.toLowerCase().replace('ngày ', 'day');
      renderFlashSaleProducts(dayIndex);
    });
  });

  // Initial render for Day 1 products
  renderFlashSaleProducts('day1');

  const allWebsiteProducts = [
    {
      id: 'pc-amd-r5-5600x-rtx3060',
      name: 'PC GVN AMD R5-5600X/ VGA RTX 3060',
      oldPrice: '22.990.000₫',
      newPrice: 19990000,
      discount: '-13%',
      rating: '★★★★☆',
      reviews: 5,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'amd',
      cpu: 'amd',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx3060',
      category: 'san-pham-da-xem' // Added category for filtering
    },
    {
      id: 'pc-intel-i5-12400f-rtx4060',
      name: 'PC GVN Intel i5-12400F/ VGA RTX 4060',
      oldPrice: '21.990.000₫',
      newPrice: 18490000,
      discount: '-16%',
      rating: '★★★★★',
      reviews: 10,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'intel',
      cpu: 'i5',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx4060',
      category: 'san-pham-da-xem'
    },
    {
      id: 'pc-intel-i3-12100f-rtx3050',
      name: 'PC GVN Intel i3-12100F/ VGA RTX 3050',
      oldPrice: '13.990.000₫',
      newPrice: 11390000,
      discount: '-19%',
      rating: '★★★★☆',
      reviews: 7,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'intel',
      cpu: 'i3',
      ram: '8gb',
      ssd: '256gb',
      vga: 'rtx3050',
      category: 'san-pham-da-xem'
    },
    {
      id: 'pc-amd-r7-7700-rtx3060',
      name: 'PC GVN AMD R7-7700/ VGA RTX 3060',
      oldPrice: '34.990.000₫',
      newPrice: 30490000,
      discount: '-13%',
      rating: '★★★★★',
      reviews: 3,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: 'above20m',
      brand: 'amd',
      cpu: 'amd',
      ram: '32gb',
      ssd: '1tb',
      vga: 'rtx3060',
      category: 'san-pham-da-xem'
    },
    // PC Bán Chạy Products
    {
      id: 'pcbc-pc-1',
      name: 'PC GVN AMD R5-5600X/ VGA RTX 3060 (Bán chạy)',
      oldPrice: '22.990.000₫',
      newPrice: 19990000,
      discount: '-13%',
      rating: '★★★★☆',
      reviews: 5,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'amd',
      cpu: 'amd',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx3060',
      category: 'pc-ban-chay'
    },
    {
      id: 'pcbc-pc-2',
      name: 'PC GVN Intel i5-12400F/ VGA RTX 4060 (Bán chạy)',
      oldPrice: '21.990.000₫',
      newPrice: 18490000,
      discount: '-16%',
      rating: '★★★★★',
      reviews: 10,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'intel',
      cpu: 'i5',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx4060',
      category: 'pc-ban-chay'
    },
    {
      id: 'pcbc-pc-3',
      name: 'PC GVN Intel i3-12100F/ VGA RTX 3050 (Bán chạy)',
      oldPrice: '13.990.000₫',
      newPrice: 11390000,
      discount: '-19%',
      rating: '★★★★☆',
      reviews: 7,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'intel',
      cpu: 'i3',
      ram: '8gb',
      ssd: '256gb',
      vga: 'rtx3050',
      category: 'pc-ban-chay'
    },
    {
      id: 'pcbc-pc-4',
      name: 'PC GVN AMD R7-7700/ VGA RTX 3060 (Bán chạy)',
      oldPrice: '34.990.000₫',
      newPrice: 30490000,
      discount: '-13%',
      rating: '★★★★★',
      reviews: 3,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: 'above20m',
      brand: 'amd',
      cpu: 'amd',
      ram: '32gb',
      ssd: '1tb',
      vga: 'rtx3060',
      category: 'pc-ban-chay'
    },
    // Laptop Gaming Bán Chạy Products
    {
      id: 'lgbc-laptop-1',
      name: 'Laptop Gaming GVN XYZ',
      oldPrice: '25.990.000₫',
      newPrice: 21990000,
      discount: '-15%',
      rating: '★★★★☆',
      reviews: 8,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: 'above20m',
      brand: 'asus',
      cpu: 'i7',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx3060',
      category: 'laptop-gaming-ban-chay'
    },
    {
      id: 'lgbc-laptop-2',
      name: 'Laptop Gaming ABC',
      oldPrice: '23.990.000₫',
      newPrice: 19990000,
      discount: '-17%',
      rating: '★★★★★',
      reviews: 12,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'msi',
      cpu: 'i5',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx3050',
      category: 'laptop-gaming-ban-chay'
    },
    {
      id: 'lgbc-laptop-3',
      name: 'Laptop Gaming DEF',
      oldPrice: '20.990.000₫',
      newPrice: 17990000,
      discount: '-14%',
      rating: '★★★★☆',
      reviews: 6,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '15_20m',
      brand: 'dell',
      cpu: 'i5',
      ram: '8gb',
      ssd: '256gb',
      vga: 'rtx3050',
      category: 'laptop-gaming-ban-chay'
    },
    {
      id: 'lgbc-laptop-4',
      name: 'Laptop Gaming GHI',
      oldPrice: '28.990.000₫',
      newPrice: 24990000,
      discount: '-14%',
      rating: '★★★★★',
      reviews: 4,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: 'above20m',
      brand: 'asus',
      cpu: 'i7',
      ram: '16gb',
      ssd: '512gb',
      vga: 'rtx4060',
      category: 'laptop-gaming-ban-chay'
    },
    // Laptop Văn Phòng Bán Chạy Products
    {
      id: 'lvpbc-laptop-1',
      name: 'Laptop Văn Phòng JKL',
      oldPrice: '15.990.000₫',
      newPrice: 12990000,
      discount: '-19%',
      rating: '★★★★☆',
      reviews: 9,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'dell',
      cpu: 'i5',
      ram: '8gb',
      ssd: '256gb',
      vga: 'integrated',
      category: 'laptop-van-phong-ban-chay'
    },
    {
      id: 'lvpbc-laptop-2',
      name: 'Laptop Văn Phòng MNO',
      oldPrice: '14.990.000₫',
      newPrice: 11990000,
      discount: '-20%',
      rating: '★★★★★',
      reviews: 11,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'asus',
      cpu: 'i3',
      ram: '8gb',
      ssd: '512gb',
      vga: 'integrated',
      category: 'laptop-van-phong-ban-chay'
    },
    {
      id: 'lvpbc-laptop-3',
      name: 'Laptop Văn Phòng PQR',
      oldPrice: '13.990.000₫',
      newPrice: 10990000,
      discount: '-21%',
      rating: '★★★★☆',
      reviews: 7,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'msi',
      cpu: 'i3',
      ram: '4gb',
      ssd: '256gb',
      vga: 'integrated',
      category: 'laptop-van-phong-ban-chay'
    },
    {
      id: 'lvpbc-laptop-4',
      name: 'Laptop Văn Phòng STU',
      oldPrice: '16.990.000₫',
      newPrice: 13990000,
      discount: '-18%',
      rating: '★★★★★',
      reviews: 5,
      img: 'https://product.hstatic.net/200000722513/product/artboard_2_copy_2_b26b97e389e04693934b7a457652d385_1024x1024.png',
      status: 'in_stock',
      priceRange: '10_15m',
      brand: 'hp',
      cpu: 'i5',
      ram: '8gb',
      ssd: '512gb',
      vga: 'integrated',
      category: 'laptop-van-phong-ban-chay'
    },
  ];

  function renderProducts(products, containerSelector) {
    const container = document.querySelector(containerSelector);
    if (!container) {
      console.error(`Container not found: ${containerSelector}`);
      return;
    }
    container.innerHTML = ''; // Clear existing products

    if (products.length === 0) {
      container.innerHTML = '<p class="text-center w-100">Không có sản phẩm nào phù hợp.</p>';
      return;
    }

    let productHtml = '';
    products.forEach(product => {
      productHtml += `
        <div class="col">
          <a href="chitietsanpham.html" class="text-decoration-none text-dark">
            <div class="product-card p-3">
              ${product.discount ? `<span class="badge badge-sale"><i class="fa-solid fa-bolt"></i> ${product.discount}</span>` : ''}
              <img src="${product.img}" class="img-fluid mb-2" alt="${product.name}">
              <h6 class="fw-bold">${product.name}</h6>
              <div class="mb-2">
                <span class="old-price">${product.oldPrice}</span>
                <span class="text-danger fw-bold">${product.newPrice.toLocaleString('vi-VN')}₫</span>
                ${product.discount ? `<span class="discount">${product.discount}</span>` : ''}
              </div>
              <div class="small text-muted">
                <span class="rating">${product.rating}</span> (${product.reviews})
              </div>
            </div>
          </a>
        </div>
      `;
    });
    container.innerHTML = productHtml;
  }

  function filterProducts(category, formId, containerSelector) {
    const form = document.getElementById(formId);
    if (!form) {
      console.error(`Form not found: ${formId}`);
      return;
    }

    const filters = {};
    new FormData(form).forEach((value, key) => {
      filters[key] = value;
    });

    const filtered = allWebsiteProducts.filter(product => {
      if (product.category !== category) return false; // Filter by section category

      if (filters.status && filters.status !== 'all' && product.status !== filters.status) {
        return false;
      }
      if (filters.price && filters.price !== 'all') {
        if (product.priceRange !== filters.price) {
          return false;
        }
      }
      if (filters.brand && filters.brand !== 'all' && product.brand.toLowerCase() !== filters.brand) {
        return false;
      }
      if (filters.cpu && filters.cpu !== 'all') {
        if (filters.cpu === 'amd' && !product.cpu.toLowerCase().includes('amd')) return false;
        if (filters.cpu !== 'amd' && !product.cpu.toLowerCase().includes(filters.cpu)) return false;
      }
      if (filters.ram && filters.ram !== 'all' && product.ram.toLowerCase() !== filters.ram) {
        return false;
      }
      if (filters.ssd && filters.ssd !== 'all' && product.ssd.toLowerCase() !== filters.ssd) {
        return false;
      }
      if (filters.vga && filters.vga !== 'all') {
        if (filters.vga === 'integrated' && product.vga !== 'integrated') return false;
        if (filters.vga !== 'integrated' && product.vga.toLowerCase() !== filters.vga) return false;
      }
      return true;
    });
    renderProducts(filtered, containerSelector);
  }

  // Initial render for each section
  renderProducts(allWebsiteProducts.filter(p => p.category === 'san-pham-da-xem'), '.san-pham-da-xem-products');
  renderProducts(allWebsiteProducts.filter(p => p.category === 'pc-ban-chay'), '.pc-ban-chay-products');
  renderProducts(allWebsiteProducts.filter(p => p.category === 'laptop-gaming-ban-chay'), '.laptop-gaming-ban-chay-products');
  renderProducts(allWebsiteProducts.filter(p => p.category === 'laptop-van-phong-ban-chay'), '.laptop-van-phong-ban-chay-products');

  // Attach event listeners to filter forms
  document.querySelectorAll('.filter-bar').forEach(filterBar => {
    const form = filterBar.closest('form');
    if (form) {
      const formId = form.id;
      const category = formId.replace('product-filter-form-', '');
      let containerSelector;
      switch(category) {
        case 'spdx': containerSelector = '.san-pham-da-xem-products'; break;
        case 'pcbc': containerSelector = '.pc-ban-chay-products'; break;
        case 'lgbc': containerSelector = '.laptop-gaming-ban-chay-products'; break;
        case 'lvpbc': containerSelector = '.laptop-van-phong-ban-chay-products'; break;
      }

      // Add change listeners to all radio buttons within the form
      form.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', () => filterProducts(category, formId, containerSelector));
      });

      // Add submit listener to the form
      form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        filterProducts(category, formId, containerSelector);
      });
    }
  });
});
