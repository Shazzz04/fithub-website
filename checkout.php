<?php
session_start();
include 'db_supplements.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $contact1 = $_POST['contact1'];
    $contact2 = $_POST['contact2'];
    $cart = json_decode($_POST['cart'], true);

    // Save order to DB
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, address, contact1, contact2, cart) VALUES (?, ?, ?, ?, ?, ?)");
    $cartJson = json_encode($cart);
    $stmt->bind_param("ssssss", $firstName, $lastName, $address, $contact1, $contact2, $cartJson);
    $stmt->execute();
    $stmt->close();

    // Return JSON response
    echo json_encode([
        'success' => true,
        'message' => "Thank you, $firstName $lastName! Your order has been placed successfully."
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>
<link rel="stylesheet" href="main.css" />
<style>
/* ===== Navbar ===== */
nav {
  width: 100%;
  background: rgba(0,0,0,0.9);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 50px;
  position: fixed;
  top: 0;
  z-index: 1000;
  box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

nav .nav__logo img {
  width: 130px;
}

nav ul {
  list-style: none;
  display: flex;
  gap: 30px;
}

nav ul li a {
  color: #f9ac54;
  text-decoration: none;
  font-weight: 600;
  font-size: 1rem;
  transition: color 0.3s;
}

nav ul li a:hover {
  color: #e5943f;
}

/* ===== Container ===== */
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: url('front4.png') center/cover no-repeat fixed;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.container {
  width: 90%;
  max-width: 500px;
  background: rgba(0,0,0,0.85);
  padding: 30px;
  border-radius: 15px;
  margin: 130px auto 50px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.4);
  color: white;
  text-align: center;
}

/* ===== Form Inputs ===== */
form input {
  width: 100%;
  padding: 14px;
  margin: 10px 0;
  border-radius: 8px;
  border: none;
  font-size: 16px;
  outline: none;
  box-shadow: inset 0 0 5px rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.05);
  color: #fff;
}

form input::placeholder {
  color: rgba(255,255,255,0.7);
}

form input:focus {
  box-shadow: 0 0 8px #f9ac54;
}

/* ===== Buttons ===== */
form button, #backButton {
  width: 100%;
  padding: 14px;
  margin-top: 15px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: 0.3s;
}

form button {
  background: #f9ac54;
  color: white;
}

form button:hover {
  background: #e5943f;
}

#backButton {
  background: #27ae60;
  color: #fff;
  display: none;
}

#backButton:hover {
  background: #219150;
}

/* ===== Success Message ===== */
#successMessage {
  display: none;
  margin-top: 20px;
  padding: 15px;
  background: rgba(46,204,113,0.9);
  border-radius: 8px;
  font-size: 1rem;
}

/* ===== Responsive ===== */
@media(max-width: 480px){
  nav { padding: 10px 20px; }
  .container { width: 95%; padding: 20px; margin-top: 100px; }
}
</style>
</head>
<body>

<!-- Navbar -->
<nav>
  <div class="nav__logo">
      <a href="main.php"><img src="logo.png" alt="logo" /></a>
  </div>
  <ul class="nav__links">
    <li><a href="main.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="class.php">Class</a></li>
    <li><a href="supplements.php">Supplements</a></li>
    <li><a href="contact.php">Contact Us</a></li>
  </ul>
</nav>

<!-- Checkout Form -->
<div class="container">
  <h2>Checkout</h2>
  <form id="checkoutForm" method="POST" action="checkout.php">
    <input type="text" name="firstName" placeholder="First Name" required>
    <input type="text" name="lastName" placeholder="Last Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="contact1" placeholder="Contact Number" required>
    <input type="text" name="contact2" placeholder="Alternate Contact Number">
    <input type="hidden" name="cart" id="cartData">
    <button type="submit">Place Order</button>
  </form>

  <div id="successMessage"></div>
  <button id="backButton" onclick="window.location.href='main.php'">Back to Main Page</button>
</div>

<script>
  // Load cart from localStorage
  const cartData = localStorage.getItem('cart');
  document.getElementById('cartData').value = cartData;

  const form = document.getElementById('checkoutForm');
  const successMsg = document.getElementById('successMessage');
  const backBtn = document.getElementById('backButton');

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(form);

    fetch('checkout.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if(data.success){
        successMsg.textContent = data.message;
        successMsg.style.display = 'block';
        backBtn.style.display = 'block';
        form.reset();
        localStorage.removeItem('cart'); // clear cart
      }
    })
    .catch(err => console.error(err));
  });
</script>

</body>
</html>

<?php $conn->close(); ?>
