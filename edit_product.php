<?php
include 'db_supplements.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if ($image) {
        $sql = "UPDATE products SET name='$name', price='$price', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        if ($image && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Product updated successfully.";
        } else {
            echo "Product updated successfully.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>