<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: admin.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body{
      background-image: url('front9.png'); /* Add your image URL here */
      background-size: cover; /* Ensure the image covers the whole page */
      background-position: center; /* Center the image */
      background-attachment: fixed; /* Make the background image fixed during scrolling */
      background-repeat: no-repeat; /* Prevent image from repeating */
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    
    .btn {
      background:rgb(155, 122, 32);
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
      background:rgb(100, 86, 25);
    }

    .h2{
        color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Admin Dashboard</h2>
    <a href="dashboard.php" class="btn">Manage Classes</a>
    <a href="supplement_dashboard.php" class="btn">Manage Supplements</a>
  </div>
</body>
</html>