<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$result = $conn->query("SELECT * FROM classes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="main.css">
</head>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: url('front2.png') no-repeat center center/cover; /* Background image */
    color: #fff;
    text-align: center;
    padding: 2rem;
}

h2 {
    margin-bottom: 2rem;
}

form {
    background: #1f2125;
    padding: 1rem; /* Reduced padding */
    border-radius: 10px;
    margin-bottom: 2rem;
    display: inline-block;
    text-align: left;
    width: 300px; /* Set a fixed width */
}

form input, form button {
    display: block;
    width: 100%;
    margin-bottom: 0.5rem; /* Reduced margin */
    padding: 0.5rem;
    border: none;
    border-radius: 5px;
}

form input {
    background: #35373b;
    color: #fff;
}

form button {
    background: #f9ac54;
    color: #111317;
    cursor: pointer;
    transition: background 0.3s;
}

form button:hover {
    background: #d79447;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem; /* Reduced margin */
}

table th, table td {
    padding: 0.5rem; /* Reduced padding */
    border: 1px solid #35373b;
}

table th {
    background: #1f2125;
}

table td {
    background: #2b2d31;
}

table a {
    color: #f9ac54;
    text-decoration: none;
    margin: 0 0.5rem;
    transition: color 0.3s;
}

table a:hover {
    color: #d79447;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #f9ac54;
    color: #111317;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
    margin-bottom: 1rem; /* Reduced margin */
}

.btn:hover {
    background: #d79447;
}
</style>
<body>
    <h2>Manage Classes</h2>

    <div class="button-group">
        <a href="process.php?add_predefined_plans=true" class="btn">Add Predefined Plans</a>
        <a href="class.php" class="btn">View Classes</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>

    <form action="process.php" method="POST">
        <input type="text" name="category" placeholder="Category" required>
        <input type="text" name="plan_name" placeholder="Plan Name" required>
        <input type="text" name="price" placeholder="Price" required>
        <input type="text" name="feature1" placeholder="Feature 1" required>
        <input type="text" name="feature2" placeholder="Feature 2" required>
        <button type="submit" name="add" class="btn">Add Class</button>
    </form>

    <h3>Existing Classes</h3>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Plan Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['plan_name']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td>
                        <a href="edit_class.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>