<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Premium E-Commerce Store</title>

<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

:root {
  --primary-color: #6366f1;
  --secondary-color: #10b981;
  --danger-color: #ef4444;
  --light-bg: #f8fafc;
  --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --card-shadow-hover: 0 20px 25px rgba(0, 0, 0, 0.15);
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: var(--light-bg);
  color: #1e293b;
}

/* Header & Navigation */
header {
  background: linear-gradient(135deg, var(--primary-color) 0%, #4f46e5 100%);
  color: #fff;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: var(--card-shadow);
  position: sticky;
  top: 0;
  z-index: 100;
}

header h2 {
  font-size: 28px;
  font-weight: 700;
  letter-spacing: -0.5px;
}

.cart-btn {
  cursor: pointer;
  background: rgba(255, 255, 255, 0.2);
  color: #fff;
  padding: 12px 18px;
  border-radius: 8px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  font-size: 16px;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.cart-btn:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.5);
  transform: translateY(-2px);
}

/* Products Container */
.container {
  max-width: 1200px;
  margin: 40px auto;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 28px;
}

/* Product Card */
.card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: var(--card-shadow);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.card:hover {
  box-shadow: var(--card-shadow-hover);
  transform: translateY(-8px);
}

.card-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  background: var(--light-bg);
}

.card-content {
  padding: 20px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.card h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
  color: #1e293b;
}

.card-price {
  font-size: 24px;
  font-weight: 700;
  color: var(--primary-color);
  margin: 12px 0;
}

.card-btn {
  background: linear-gradient(135deg, var(--secondary-color) 0%, #059669 100%);
  color: white;
  border: none;
  padding: 12px 16px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  margin-top: auto;
}

.card-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.card-btn:active {
  transform: scale(0.98);
}

/* Modal Overlay */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  animation: fadeIn 0.3s ease;
}

.modal-overlay.active {
  display: flex;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Cart Modal */
.modal-content {
  background: #fff;
  width: 90%;
  max-width: 500px;
  border-radius: 12px;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
  animation: slideUp 0.3s ease;
  display: flex;
  flex-direction: column;
  max-height: 80vh;
}

@keyframes slideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.modal-header {
  padding: 24px;
  background: linear-gradient(135deg, var(--primary-color) 0%, #4f46e5 100%);
  color: white;
  border-radius: 12px 12px 0 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-header h3 {
  font-size: 22px;
  font-weight: 700;
}

.close-btn {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.close-btn:hover {
  background: rgba(255, 255, 255, 0.3);
}

.modal-body {
  padding: 24px;
  overflow-y: auto;
  flex-grow: 1;
}

.empty-cart {
  text-align: center;
  padding: 40px 20px;
  color: #94a3b8;
}

.empty-cart-icon {
  font-size: 48px;
  margin-bottom: 16px;
}

/* Cart Items */
.cart-item {
  display: flex;
  gap: 12px;
  margin-bottom: 16px;
  padding-bottom: 16px;
  border-bottom: 1px solid #e2e8f0;
}

.cart-item-image {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  background: var(--light-bg);
}

.cart-item-details {
  flex-grow: 1;
}

.cart-item-name {
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 4px;
}

.cart-item-price {
  color: var(--primary-color);
  font-weight: 700;
  font-size: 16px;
}

.quantity-controls {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}

.qty-btn {
  background: var(--light-bg);
  border: 1px solid #e2e8f0;
  width: 28px;
  height: 28px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.2s ease;
}

.qty-btn:hover {
  background: var(--primary-color);
  color: white;
  border-color: var(--primary-color);
}

.qty-display {
  font-weight: 600;
  min-width: 30px;
  text-align: center;
}

.remove-btn {
  background: #fee2e2;
  color: var(--danger-color);
  border: none;
  padding: 6px 10px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 12px;
  font-weight: 600;
  transition: all 0.2s ease;
}

.remove-btn:hover {
  background: var(--danger-color);
  color: white;
}

/* Modal Footer */
.modal-footer {
  padding: 24px;
  border-top: 2px solid #e2e8f0;
  background: var(--light-bg);
  border-radius: 0 0 12px 12px;
}

.price-summary {
  margin-bottom: 16px;
}

.price-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
  color: #64748b;
}

.price-row.total {
  font-size: 20px;
  font-weight: 700;
  color: #1e293b;
  border-top: 2px solid #e2e8f0;
  padding-top: 12px;
  margin-top: 12px;
}

.modal-buttons {
  display: flex;
  gap: 12px;
}

.btn-primary, .btn-secondary {
  flex: 1;
  padding: 12px 16px;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 14px;
}

.btn-primary {
  background: linear-gradient(135deg, var(--primary-color) 0%, #4f46e5 100%);
  color: white;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
}

.btn-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.btn-secondary {
  background: var(--light-bg);
  color: #64748b;
  border: 1px solid #e2e8f0;
}

.btn-secondary:hover {
  background: #e2e8f0;
}

/* Checkout Modal */
.checkout-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 6px;
  color: #1e293b;
}

.form-group input, .form-group select {
  padding: 10px 12px;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  font-size: 14px;
  transition: all 0.2s ease;
}

.form-group input:focus, .form-group select:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

/* Order Confirmation */
.confirmation-content {
  text-align: center;
}

.success-icon {
  font-size: 64px;
  margin-bottom: 16px;
  animation: scaleIn 0.5s ease;
}

@keyframes scaleIn {
  from { transform: scale(0); }
  to { transform: scale(1); }
}

.confirmation-title {
  font-size: 24px;
  font-weight: 700;
  color: var(--secondary-color);
  margin-bottom: 8px;
}

.confirmation-message {
  color: #64748b;
  margin-bottom: 24px;
}

.order-details {
  background: var(--light-bg);
  padding: 20px;
  border-radius: 8px;
  text-align: left;
  margin: 20px 0;
}

.order-detail-row {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #e2e8f0;
}

.order-detail-row:last-child {
  border-bottom: none;
}

/* Responsive */
@media (max-width: 768px) {
  header {
    flex-direction: column;
    gap: 16px;
  }

  .container {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
    padding: 16px;
  }

  .modal-content {
    width: 95%;
    max-width: 100%;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .modal-buttons {
    flex-direction: column;
  }
}
</style>
</head>

<body>

<header>
  <h2>🛍️ Premium Store</h2>
  <div class="cart-btn" onclick="toggleCart()">🛒 Cart (<span id="cartCount">0</span>)</div>
</header>

<div class="container" id="productList"></div>

<!-- Cart Modal -->
<div class="modal-overlay" id="cartModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Your Shopping Cart</h3>
      <button class="close-btn" onclick="toggleCart()">✕</button>
    </div>
    
    <div class="modal-body" id="cartItemsContainer">
      <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <p>Your cart is empty</p>
      </div>
    </div>
    
    <div class="modal-footer">
      <div class="price-summary">
        <div class="price-row">
          <span>Subtotal:</span>
          <span>$<span id="subtotalPrice">0.00</span></span>
        </div>
        <div class="price-row">
          <span>Tax (10%):</span>
          <span>$<span id="taxPrice">0.00</span></span>
        </div>
        <div class="price-row total">
          <span>Total:</span>
          <span>$<span id="totalPrice">0.00</span></span>
        </div>
      </div>
      <div class="modal-buttons">
        <button class="btn-secondary" onclick="toggleCart()">Continue Shopping</button>
        <button class="btn-primary" onclick="proceedToCheckout()" id="checkoutBtn" disabled>Proceed to Checkout</button>
      </div>
    </div>
  </div>
</div>

<!-- Checkout Modal -->
<div class="modal-overlay" id="checkoutModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Checkout</h3>
      <button class="close-btn" onclick="closeCheckout()">✕</button>
    </div>
    
    <div class="modal-body">
      <form class="checkout-form" id="checkoutForm" onsubmit="submitOrder(event)">
        
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="fullName" required>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
          <label for="address">Street Address</label>
          <input type="text" id="address" name="address" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" required>
          </div>
          <div class="form-group">
            <label for="zip">ZIP Code</label>
            <input type="text" id="zip" name="zip" required>
          </div>
        </div>

        <div class="form-group">
          <label for="cardNumber">Card Number</label>
          <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="expiry">Expiry Date</label>
            <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
          </div>
          <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
          </div>
        </div>

      </form>

      <div class="price-summary" style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e2e8f0;">
        <div class="price-row">
          <span>Total Amount:</span>
          <span style="color: var(--primary-color); font-weight: 700; font-size: 18px;">$<span id="checkoutTotal">0.00</span></span>
        </div>
      </div>
    </div>
    
    <div class="modal-footer">
      <div class="modal-buttons">
        <button class="btn-secondary" onclick="closeCheckout()">Back</button>
        <button class="btn-primary" onclick="document.getElementById('checkoutForm').dispatchEvent(new Event('submit'))">Complete Order</button>
      </div>
    </div>
  </div>
</div>

<!-- Order Confirmation Modal -->
<div class="modal-overlay" id="confirmationModal">
  <div class="modal-content">
    <div class="modal-body">
      <div class="confirmation-content">
        <div class="success-icon">✅</div>
        <h3 class="confirmation-title">Order Confirmed!</h3>
        <p class="confirmation-message">Thank you for your purchase.</p>
        
        <div class="order-details">
          <div class="order-detail-row">
            <span>Order ID:</span>
            <span id="orderId" style="font-weight: 700;">#12345</span>
          </div>
          <div class="order-detail-row">
            <span>Customer Name:</span>
            <span id="orderName">-</span>
          </div>
          <div class="order-detail-row">
            <span>Delivery Address:</span>
            <span id="orderAddress">-</span>
          </div>
          <div class="order-detail-row">
            <span>Total Amount:</span>
            <span style="font-weight: 700; color: var(--primary-color);">$<span id="orderTotal">0.00</span></span>
          </div>
          <div class="order-detail-row">
            <span>Estimated Delivery:</span>
            <span id="estimatedDelivery">5-7 Business Days</span>
          </div>
        </div>

        <p style="color: #64748b; font-size: 14px; margin-top: 20px;">
          A confirmation email has been sent to your inbox. You can track your order using the Order ID.
        </p>
      </div>
    </div>
    
    <div class="modal-footer">
      <div class="modal-buttons">
        <button class="btn-primary" onclick="completeOrder()" style="flex: 1;">Continue Shopping</button>
      </div>
    </div>
  </div>
</div>

<script>
const products = @json($products);
let cart = [];

function loadProducts() {
  const list = document.getElementById("productList");
  list.innerHTML = "";

  products.forEach(p => {
    list.innerHTML += `
      <div class="card">
        <img src="${p.image}" class="card-image" alt="${p.name}">
        <div class="card-content">
          <h3>${p.name}</h3>
          <div class="card-price">$${parseFloat(p.price).toFixed(2)}</div>
          <button class="card-btn" onclick="addToCart(${p.id})">Add to Cart</button>
        </div>
      </div>
    `;
  });
}

function addToCart(id) {
  const product = products.find(p => p.id === id);
  const existingItem = cart.find(item => item.id === id);

  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({ ...product, quantity: 1 });
  }

  updateCart();
}

function updateCart() {
  document.getElementById("cartCount").innerText = cart.length;
  const cartItemsContainer = document.getElementById("cartItemsContainer");

  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `
      <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <p>Your cart is empty</p>
      </div>
    `;
    document.getElementById("checkoutBtn").disabled = true;
    updatePrices();
    return;
  }

  document.getElementById("checkoutBtn").disabled = false;
  cartItemsContainer.innerHTML = "";

  cart.forEach((item, index) => {
    cartItemsContainer.innerHTML += `
      <div class="cart-item">
        <img src="${item.image}" class="cart-item-image" alt="${item.name}">
        <div class="cart-item-details">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-price">$${parseFloat(item.price).toFixed(2)}</div>
          <div class="quantity-controls">
            <button class="qty-btn" onclick="decreaseQty(${index})">−</button>
            <span class="qty-display">${item.quantity}</span>
            <button class="qty-btn" onclick="increaseQty(${index})">+</button>
            <button class="remove-btn" onclick="removeFromCart(${index})">Remove</button>
          </div>
        </div>
      </div>
    `;
  });

  updatePrices();
}

function increaseQty(index) {
  cart[index].quantity += 1;
  updateCart();
}

function decreaseQty(index) {
  if (cart[index].quantity > 1) {
    cart[index].quantity -= 1;
    updateCart();
  }
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCart();
}

function updatePrices() {
  let subtotal = 0;

  cart.forEach(item => {
    subtotal += parseFloat(item.price) * item.quantity;
  });

  const tax = subtotal * 0.1;
  const total = subtotal + tax;

  document.getElementById("subtotalPrice").innerText = subtotal.toFixed(2);
  document.getElementById("taxPrice").innerText = tax.toFixed(2);
  document.getElementById("totalPrice").innerText = total.toFixed(2);
  document.getElementById("checkoutTotal").innerText = total.toFixed(2);
}

function toggleCart() {
  document.getElementById("cartModal").classList.toggle("active");
}

function proceedToCheckout() {
  if (cart.length === 0) return;
  document.getElementById("cartModal").classList.remove("active");
  document.getElementById("checkoutModal").classList.add("active");
}

function closeCheckout() {
  document.getElementById("checkoutModal").classList.remove("active");
  document.getElementById("cartModal").classList.add("active");
}

function submitOrder(event) {
  event.preventDefault();

  const fullName = document.getElementById("fullName").value;
  const email = document.getElementById("email").value;
  const phone = document.getElementById("phone").value;
  const address = document.getElementById("address").value;
  const city = document.getElementById("city").value;
  const zip = document.getElementById("zip").value;
  const total = document.getElementById("checkoutTotal").innerText;

  fetch('/order', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
      fullName,
      email,
      phone,
      address,
      city,
      zip,
      total,
      cart
    })
  })
  .then(res => res.json())
  .then(data => {
      document.getElementById("orderId").innerText = "#" + data.order_id;
      document.getElementById("orderName").innerText = fullName;
      document.getElementById("orderAddress").innerText = `${address}, ${city} ${zip}`;
      document.getElementById("orderTotal").innerText = total;
      document.getElementById("checkoutModal").classList.remove("active");
      document.getElementById("confirmationModal").classList.add("active");
  });
}

function completeOrder() {
  cart = [];
  document.getElementById("cartCount").innerText = "0";
  document.getElementById("checkoutForm").reset();
  document.getElementById("confirmationModal").classList.remove("active");
  updateCart();
}

loadProducts();
</script>

</body>
</html>
