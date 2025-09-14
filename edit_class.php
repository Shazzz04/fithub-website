<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM classes WHERE id=$id");
$class = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Class</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Class</h2>

    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $class['id']; ?>">
        <input type="text" name="category" placeholder="Category" value="<?php echo $class['category']; ?>" required>
        <input type="text" name="plan_name" placeholder="Plan Name" value="<?php echo $class['plan_name']; ?>" required>
        <input type="text" name="price" placeholder="Price" value="<?php echo $class['price']; ?>" required>
        <input type="text" name="feature1" placeholder="Feature 1" value="<?php echo $class['feature1']; ?>" required>
        <input type="text" name="feature2" placeholder="Feature 2" value="<?php echo $class['feature2']; ?>" required>
        <button type="submit" name="edit">Update Class</button>
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>