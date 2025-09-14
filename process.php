<?php
include 'db.php';
session_start();

// Add class
if (isset($_POST['add']) && isset($_SESSION['admin'])) {
    $category = $_POST['category'];
    $name = $_POST['plan_name'];
    $price = $_POST['price'];
    $feature1 = $_POST['feature1'];
    $feature2 = $_POST['feature2'];

    $conn->query("INSERT INTO classes (category, plan_name, price, feature1, feature2) VALUES ('$category', '$name', '$price', '$feature1', '$feature2')");
    header("Location: dashboard.php");
}

// Edit class
if (isset($_POST['edit']) && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $name = $_POST['plan_name'];
    $price = $_POST['price'];
    $feature1 = $_POST['feature1'];
    $feature2 = $_POST['feature2'];

    $conn->query("UPDATE classes SET category='$category', plan_name='$name', price='$price', feature1='$feature1', feature2='$feature2' WHERE id=$id");
    header("Location: dashboard.php");
}

// Delete class
if (isset($_GET['delete']) && isset($_SESSION['admin'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM classes WHERE id=$id");
    header("Location: dashboard.php");
}

// Handle membership form submission
if (isset($_POST['join'])) {
    $plan_id = $_POST['plan_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("INSERT INTO members (plan_id, name, email) VALUES ('$plan_id', '$name', '$email')");
    echo "Membership request submitted!";
}

// Add predefined plans
if (isset($_GET['add_predefined_plans']) && isset($_SESSION['admin'])) {
    $plans = [
        ['Individuals Plan', 'Basic', 16, 'Smart workout plan', 'At-home workouts'],
        ['Individuals Plan', 'Standard', 29, 'Personalized training', 'Gym access (5 days/week), Group fitness classes'],
        ['Individuals Plan', 'Premium', 45, '24/7 Gym access', 'Personal trainer, Nutrition guide, Sauna & pool access'],
        ['Couples Plan', 'Basic', 30, 'Access for two', 'Home workout guide, Weekend gym access'],
        ['Couples Plan', 'Standard', 50, 'Gym access (6 days/week)', 'Couple training sessions, Group fitness classes'],
        ['Couples Plan', 'Premium', 75, 'Unlimited gym access', 'Personal trainer, Nutrition plan, Spa & sauna'],
        ['Students Plan', 'Basic', 12, 'Flexible workout plans', 'Weekend gym access'],
        ['Students Plan', 'Standard', 22, 'Full-time gym access', 'Fitness classes, Free WiFi & study area'],
        ['Students Plan', 'Premium', 35, '24/7 gym access', 'Personal training, Exam stress management yoga']
    ];

    $changes_found = false;

    foreach ($plans as $plan) {
        $category = $plan[0];
        $plan_name = $plan[1];
        $price = $plan[2];
        $feature1 = $plan[3];
        $feature2 = $plan[4];

        $result = $conn->query("SELECT * FROM classes WHERE category='$category' AND plan_name='$plan_name' AND price='$price' AND feature1='$feature1' AND feature2='$feature2'");

        if ($result->num_rows == 0) {
            $conn->query("INSERT INTO classes (category, plan_name, price, feature1, feature2) VALUES ('$category', '$plan_name', '$price', '$feature1', '$feature2')");
            $changes_found = true;
        }
    }

    if ($changes_found) {
        header("Location: dashboard.php");
    } else {
        echo "No changes found. Predefined plans already exist.";
    }
}
?>