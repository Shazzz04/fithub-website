<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Supplements Availability</title>

<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

<!-- Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />

<!-- CSS -->
<link rel="stylesheet" href="style.css" />
</head>
<style>
  /* ================= Global Styles ================= */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: url('front5.png') center/cover no-repeat fixed;
  color: white;
}

/* ================= Nav Bar ================= */
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background: rgba(0,0,0,0.8);
  position: sticky;
  top: 0;
  z-index: 999;
}

nav .nav__logo img {
  height: 50px;
}

nav ul.nav__links {
  list-style: none;
  display: flex;
  gap: 2rem;
}

nav ul.nav__links li a {
  text-decoration: none;
  color: white;
  font-weight: 500;
  transition: color 0.3s;
}

nav ul.nav__links li a:hover {
  color: #f9ac54;
}

/* Cart icon */
.nav__cart a {
  color: white;
  text-decoration: none;
  font-size: 1.2rem;
  position: relative;
}

.nav__cart #cartCount {
  background: #f9ac54;
  color: black;
  border-radius: 50%;
  padding: 2px 7px;
  font-size: 0.8rem;
  position: absolute;
  top: -8px;
  right: -10px;
}

/* Hamburger Menu (Mobile) */
.menu-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
  color: white;
}

ul.nav__links.active {
  display: flex;
  flex-direction: column;
  background: rgba(0,0,0,0.95);
  position: absolute;
  top: 70px;
  right: 0;
  width: 200px;
  padding: 1rem;
  border-radius: 5px;
}

/* ================= Container ================= */
.container {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 2rem;
}

/* ================= Dropdown Section ================= */
.dropdown-section {
  text-align: center;
  margin-bottom: 2rem;
}

.dropdown-section h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.dropdown-section label {
  font-size: 1.2rem;
  margin-right: 1rem;
}

.dropdown-section select {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  border-radius: 5px;
  border: none;
  outline: none;
}

/* ================= Product Grid ================= */
.product-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}

.product-item {
  background: rgba(0,0,0,0.7);
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
  transition: all 0.3s ease;
}

.product-item img {
  width: 80%;
  border-radius: 10px;
  margin-bottom: 1rem;
}

.product-item h3 {
  color: #f9ac54;
  margin-bottom: 0.5rem;
}

.product-item p {
  margin-bottom: 1rem;
}

.product-item button {
  padding: 0.5rem 1rem;
  background: #f9ac54;
  border: none;
  color: black;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s;
}

.product-item button:hover {
  background: #e5943f;
}

/* ================= Cart Table ================= */
.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

.cart-table th, .cart-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
  color: white;
}

.cart-table th {
  background: #f9ac54;
  color: black;
}

.cart-table td input[type="number"] {
  width: 60px;
  padding: 5px;
  border-radius: 5px;
}

.cart-table td button {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s;
}

.cart-table td button:hover {
  background: #c0392b;
}

/* ================= Cart Footer ================= */
.cart-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}

.cart-footer .total {
  background: #f9ac54;
  padding: 0.5rem 1rem;
  border-radius: 5px;
}

.cart-footer button {
  background: #27ae60;
  color: white;
  border: none;
  padding: 0.5rem 1.5rem;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s;
}

.cart-footer button:hover {
  background: #219150;
}

/* ================= Cart Drawer ================= */
.cart-drawer {
  position: fixed;
  top: 0;
  right: -100%;
  width: 320px;
  height: 100%;
  background: rgba(0,0,0,0.95);
  transition: right 0.4s ease;
  z-index: 10000;
  display: flex;
  flex-direction: column;
}

.cart-drawer-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #f9ac54;
  color: #f9ac54;
}

.cart-drawer-items {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
}

.cart-drawer-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
  color: white;
  border-bottom: 1px solid #444;
  padding-bottom: 5px;
}

.cart-drawer-footer {
  padding: 1rem;
  border-top: 1px solid #f9ac54;
  text-align: center;
}

.cart-drawer-footer button {
  background: #f9ac54;
  color: black;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  font-weight: 600;
  transition: background 0.3s;
}

.cart-drawer-footer button:hover {
  background: #e5943f;
}

/* ================= Responsive ================= */
@media (max-width: 1024px) {
  .product-list {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .product-list {
    grid-template-columns: 1fr;
  }
  
  .menu-toggle {
    display: block;
  }

  nav ul.nav__links {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 70px;
    right: 0;
    background: rgba(0,0,0,0.95);
    padding: 1rem;
    border-radius: 5px;
  }

  nav ul.nav__links li {
    margin-bottom: 1rem;
  }
}
</style>
<body>

<!-- ================= Nav Bar ================= -->
<nav>
  <div class="nav__logo">
    <a href="#"><img src="logo.png" alt="Logo"></a>
  </div>
  
  <ul class="nav__links">
    <li><a href="main.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="class.php">Class</a></li>
    <li><a href="supplements.php">Supplements</a></li>
    <li><a href="contact.php">Contact Us</a></li>
  </ul>
  
  <div class="nav__cart">
    <a href="#" id="cartIcon">🛒 <span id="cartCount">0</span></a>
  </div>

  <div class="menu-toggle" id="mobile-menu">
    <span>&#9776;</span>
  </div>
</nav>

<!-- ================= Main Container ================= -->
<div class="container">

  <!-- Category Dropdown -->
  <div class="dropdown-section">
    <h1>Check Supplements Availability</h1>
    <label for="category">Choose Category:</label>
    <select id="category">
      <option value="">-- Select Category --</option>
      <option value="protein">Protein Supplements</option>
      <option value="weight-gainers">Weight Gainers</option>
      <option value="creatine">Creatine</option>
    </select>
  </div>

  <!-- Product Grid -->
  <div id="supplements-section" style="display: none;">
    <h2>Our Supplements & Vitamins</h2>
    <div class="product-list" id="productList"></div>
  </div>

  <!-- Cart Table -->
  <div id="cart-section" style="display: none;">
    <h2>Your Cart</h2>
    <table class="cart-table" id="cartItems"></table>
    <div class="cart-footer">
      <p class="total">Total: $<span id="cartTotal">0</span></p>
      <button id="checkoutButton">Checkout</button>
    </div>
  </div>

</div>

<!-- ================= Cart Drawer ================= -->
<div id="cartDrawer" class="cart-drawer">
  <div class="cart-drawer-header">
    <h3>Your Cart</h3>
    <span id="closeCart" style="cursor:pointer;">&times;</span>
  </div>
  <div class="cart-drawer-items" id="cartDrawerItems"></div>
  <div class="cart-drawer-footer">
    <p>Total: $<span id="cartDrawerTotal">0</span></p>
    <button id="drawerCheckoutBtn">Checkout</button>
  </div>
</div>

<!-- ================= JS ================= -->
<script>
// ======== Hamburger Mobile Menu ========
const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelector('ul.nav__links');
mobileMenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// ======== Product Data ========
const productsByCategory = {
  protein: [
    { name: "Whey Protein", price: 40, image: "Whey_Protein.png" },
    { name: "Casein Protein", price: 45, image: "Casein_Protein.png" },
    { name: "Soy Protein", price: 35, image: "Soy_Protein.png" },
    { name: "Pea Protein", price: 30, image: "Pea_Protein.png" },
    { name: "Hemp Protein", price: 50, image: "Hemp_Protein.png" },
  ],
  "weight-gainers": [
    { name: "Mass Gainer", price: 60, image: "Mass_Gainer.png" },
    { name: "Weight Gainer Blend", price: 55, image: "Weight_Gainer_Blend.png" },
    { name: "Super Mass Gainer", price: 70, image: "Super_Mass_Gainer.png" },
    { name: "Serious Mass", price: 65, image: "Serious_Mass.png" },
    { name: "Pro Gainer", price: 75, image: "Pro_Gainer.png" },
  ],
  creatine: [
    { name: "Creatine Monohydrate", price: 25, image: "Creatine_Monohydrate.png" },
    { name: "Creatine HCL", price: 30, image: "Creatine_HCL.png" },
    { name: "Buffered Creatine", price: 35, image: "Buffered_Creatine.png" },
    { name: "Micronized Creatine", price: 28, image: "Micronized_Creatine.png" },
    { name: "Creatine Ethyl Ester", price: 32, image: "Creatine_Ethyl_Ester.png" },
  ]
};

// ======== UI References ========
const categoryDropdown = document.getElementById("category");
const productList = document.getElementById("productList");
const supplementsSection = document.getElementById("supplements-section");
const cartItems = document.getElementById("cartItems");
const cartTotal = document.getElementById("cartTotal");
const cartSection = document.getElementById("cart-section");
const cartIcon = document.getElementById('cartIcon');
const cartDrawer = document.getElementById('cartDrawer');
const closeCart = document.getElementById('closeCart');
const cartDrawerItems = document.getElementById('cartDrawerItems');
const cartDrawerTotal = document.getElementById('cartDrawerTotal');
const drawerCheckoutBtn = document.getElementById('drawerCheckoutBtn');
let cart = [];

// ======== Category Change ========
categoryDropdown.addEventListener("change", () => {
  const category = categoryDropdown.value;
  productList.innerHTML = "";
  if (category) {
    supplementsSection.style.display = "block";
    if (productsByCategory[category]) {
      productsByCategory[category].forEach((product, index) => {
        let productHtml = `
          <div class="product-item">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
            <button onclick="addToCart(${index}, '${category}')">Add to Cart</button>
          </div>
        `;
        productList.innerHTML += productHtml;
      });
    }
  } else {
    supplementsSection.style.display = "none";
  }
});

// ======== Cart Functions ========
function addToCart(index, category) {
  const product = productsByCategory[category][index];
  const existingItem = cart.find(item => item.name === product.name);
  if (existingItem) existingItem.quantity++;
  else cart.push({ ...product, quantity: 1 });

  updateCartUI();
  updateCartCount();
  updateCartDrawer();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCartUI();
  updateCartCount();
  updateCartDrawer();
}

function updateQuantity(index, quantity) {
  cart[index].quantity = parseInt(quantity);
  updateCartUI();
  updateCartCount();
  updateCartDrawer();
}

function updateCartUI() {
  cartItems.innerHTML = "";
  let total = 0;
  cart.forEach((item, index) => {
    total += item.price * item.quantity;
    cartItems.innerHTML += `
      <tr>
        <td>${item.name}</td>
        <td>$${item.price}</td>
        <td><input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)"></td>
        <td><button onclick="removeFromCart(${index})">Remove</button></td>
      </tr>
    `;
  });
  cartTotal.textContent = total;
  cartSection.style.display = cart.length ? "block" : "none";
}

// ======== Cart Count ========
function updateCartCount() {
  const cartCount = document.getElementById('cartCount');
  cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
}
updateCartCount();

// ======== Cart Drawer ========
cartIcon.addEventListener('click', () => {
  cartDrawer.style.right = '0';
  updateCartDrawer();
});
closeCart.addEventListener('click', () => cartDrawer.style.right = '-100%');

function updateCartDrawer() {
  cartDrawerItems.innerHTML = '';
  let total = 0;
  cart.forEach(item => {
    total += item.price * item.quantity;
    const itemDiv = document.createElement('div');
    itemDiv.className = 'cart-drawer-item';
    itemDiv.innerHTML = `<span>${item.name} x${item.quantity}</span><span>$${item.price*item.quantity}</span>`;
    cartDrawerItems.appendChild(itemDiv);
  });
  cartDrawerTotal.textContent = total;
}

// ======== Checkout Buttons ========
document.getElementById("checkoutButton").addEventListener('click', () => {
  if (!cart.length) return alert("Your cart is empty!");
  localStorage.setItem('cart', JSON.stringify(cart));
  window.location.href = 'checkout.php';
});
drawerCheckoutBtn.addEventListener('click', () => {
  if (!cart.length) return alert("Your cart is empty!");
  localStorage.setItem('cart', JSON.stringify(cart));
  window.location.href = 'checkout.php';
});
</script>

</body>
</html>

<?php $conn->close(); ?>
