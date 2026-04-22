// public/js/cart.js

class CartManager {
  constructor() {
    this.storageKey = "fahasa_cart";
    this.isLoggedIn = window.isLoggedIn || false; // Set từ PHP
  }

  // Lấy cart từ localStorage
  getLocalCart() {
    const cart = localStorage.getItem(this.storageKey);
    return cart ? JSON.parse(cart) : [];
  }

  // Lưu cart vào localStorage
  saveLocalCart(cart) {
    localStorage.setItem(this.storageKey, JSON.stringify(cart));
  }

  // Xóa localStorage
  clearLocalCart() {
    localStorage.removeItem(this.storageKey);
  }

  // Thêm sản phẩm vào giỏ
  async addToCart(productId, quantity = 1) {
    try {
      const response = await fetch(BASE_URL + "cart/add", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `product_id=${productId}&quantity=${quantity}`,
      });

      const data = await response.json();

      if (data.success) {
        if (data.storage === "local") {
          // Chưa đăng nhập → lưu local
          this.addToLocalCart(productId, quantity);
        }

        // Cập nhật cart count
        this.updateCartCount(data.cartCount || this.getLocalCartCount());
        this.showNotification(data.message, "success");
      } else {
        this.showNotification(data.message, "error");
      }
    } catch (error) {
      console.error("Add to cart error:", error);
      this.showNotification("Có lỗi xảy ra", "error");
    }
  }

  // Thêm vào localStorage
  addToLocalCart(productId, quantity) {
    let cart = this.getLocalCart();
    const existing = cart.find((item) => item.product_id === productId);

    if (existing) {
      existing.quantity += quantity;
    } else {
      cart.push({ product_id: productId, quantity: quantity });
    }

    this.saveLocalCart(cart);
  }

  // Đồng bộ cart khi login
  async syncCartOnLogin() {
    const localCart = this.getLocalCart();

    if (localCart.length === 0) return;

    try {
      const response = await fetch(BASE_URL + "cart/syncFromLocal", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cart: localCart }),
      });

      const data = await response.json();

      if (data.success) {
        this.clearLocalCart();
        this.updateCartCount(data.cartCount);
        console.log("Cart synced successfully");
      }
    } catch (error) {
      console.error("Sync cart error:", error);
    }
  }

  // Đếm số item trong local cart
  getLocalCartCount() {
    const cart = this.getLocalCart();
    return cart.reduce((sum, item) => sum + item.quantity, 0);
  }

  // Cập nhật số hiển thị trên icon cart
  updateCartCount(count) {
    const badges = document.querySelectorAll(".cart-badge, .cart-count");
    badges.forEach(badge => {
      badge.textContent = count;
      badge.style.display = count > 0 ? "inline-block" : "none";
    });
  }

  // Hiển thị thông báo
  showNotification(message, type = "info") {
    // Có thể dùng Bootstrap toast hoặc custom notification
    alert(message); // Tạm thời dùng alert
  }
}

// Khởi tạo
// Sync cart khi load trang (nếu user vừa login)
if (window.needSyncCart === true && localStorage.getItem("fahasa_cart")) {
  console.log("Detected need to sync cart, syncing...");
  cartManager.syncCartOnLogin().then(() => {
    console.log("Cart sync completed");
  });
} else if (window.isLoggedIn) {
  // Nếu đã login rồi, chỉ cập nhật cart count từ server
  cartManager.updateCartCount();
}

// Export để dùng global
window.cartManager = cartManager;

// Export global function để update cart badge
window.updateCartBadge = function(count) {
  const badges = document.querySelectorAll(".cart-badge, .cart-count");
  badges.forEach(badge => {
    badge.textContent = count;
    badge.style.display = count > 0 ? "inline-block" : "none";
  });
};
