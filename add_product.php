<?php
include 'db_supplements.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    $sql = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Product added successfully.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>