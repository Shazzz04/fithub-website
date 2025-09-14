<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: admin.php');
  exit();
}
include 'db_supplements.php';

// Handle form submission for adding/editing supplements
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];

  if ($id) {
    // Update supplement
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $name, $price, $image, $id);
  } else {
    // Add new supplement
    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);
  }
  $stmt->execute();
  $stmt->close();
}

// Handle delete request
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

// Fetch all supplements
$supplements = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplement Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 10px;
      text-align: center;
    }
    th {
      background:rgb(203, 122, 16);
    }
    .btn {
      background:rgb(174, 154, 39);
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
      margin: 10px;
      text-decoration: none;
      font-size: 16px;
    }
    .btn:hover {
      background:rgba(145, 128, 33, 0.61);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Manage Supplements</h2>
    <form method="POST" action="supplement_dashboard.php">
      <input type="hidden" name="id" id="supplementId">
      <input type="text" name="name" id="supplementName" placeholder="Supplement Name" required>
      <input type="number" name="price" id="supplementPrice" placeholder="Price" required>
      <input type="text" name="image" id="supplementImage" placeholder="Image URL" required>
      <button type="submit" class="btn">Save</button>
    </form>
    <h3>Existing Supplements</h3>
    <table>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
      <?php while ($supplement = $supplements->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $supplement['name']; ?></td>
        <td><?php echo $supplement['price']; ?></td>
        <td><img src="<?php echo $supplement['image']; ?>" alt="<?php echo $supplement['name']; ?>" width="50"></td>
        <td>
          <button class="btn" onclick="editSupplement(<?php echo $supplement['id']; ?>, '<?php echo $supplement['name']; ?>', <?php echo $supplement['price']; ?>, '<?php echo $supplement['image']; ?>')">Edit</button>
          <a href="supplement_dashboard.php?delete=<?php echo $supplement['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this supplement?')">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>

  <script>
    function editSupplement(id, name, price, image) {
      document.getElementById('supplementId').value = id;
      document.getElementById('supplementName').value = name;
      document.getElementById('supplementPrice').value = price;
      document.getElementById('supplementImage').value = image;
    }
  </script>
</body>
</html>

<?php
$conn->close();
?>