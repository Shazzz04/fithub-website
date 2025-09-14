<?php
include 'db.php'; // Include the database connection file

$result = $conn->query("SELECT * FROM classes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Plans</title>
    <link rel="stylesheet" href="main.css"> <!-- Linking main.css -->
</head>

<style>
body {
    background-image: url('front2.png'); /* Add your image URL here */
    background-size: cover; /* Ensure the image covers the whole page */
    background-position: center; /* Center the image */
    background-attachment: fixed; /* Make the background image fixed during scrolling */
    background-repeat: no-repeat; /* Prevent image from repeating */
}

.price__container {
    max-width: 1200px; /* Increase the max-width for wider layout */
    margin: 0 auto;
    padding: 2rem;
}

/* Grid layout - 3 columns in one row */
.price__grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(300px, 1fr)); /* Adjust for wider boxes */
    gap: 2rem; /* Space between items */
    justify-content: center;
    padding: 0 2rem; /* Add padding to prevent grid touching borders */
}

/* Price card styles */
.price__card {
    padding: 2rem;
    background-color: black; /* Card background black */
    border-radius: 8px;
    text-align: center;
    transition: 0.3s;
    width: 100%; /* Full width of the grid */
    margin: 0 auto; /* Centering card */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.price__card:hover {
    background-color: #222; /* Slightly lighter on hover */
    border: 2px solid var(--secondary-color);
}

/* Headings for section titles (Individual, Couples, Students) */
h3 {
    text-align: center;
    color: white; /* White color for section titles */
    margin-top: 2rem;
    font-size: 2rem; /* Make title bigger */
}

.price__container h3 {
    font-size: 2.5rem; /* Larger size for section header */
    color: white; /* White color for section titles */
}

/* Pricing Plan Titles (Individual, Couples, Students) */
h4 {
    color: #f9ac54; /* Orange color for plan names */
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

/* Prices styling */
.price__card h3 {
    color: white; /* White color for prices */
    font-size: 2rem; /* Adjust font size if needed */
    margin-bottom: 1rem;
}

/* Features styling */
.price__card p {
    color: var(--white);
    font-size: 1rem;
    margin: 0.5rem 0; /* Add margin for spacing between features */
}

/* Join Now button styles */
.price__btn {
    display: block;
    margin: 1.5rem auto 0; /* Centering button */
    padding: 12px 25px;
    color: white;
    background-color: #f9ac54; /* Orange button */
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
    width: fit-content;
    text-align: center; /* Ensure text inside is centered */
}

.price__btn:hover {
    background-color: #f4861f; /* Darker orange on hover */
}

/* Responsive Design - Adjust for mobile screens */
@media (max-width: 768px) {
    .price__grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on tablets */
    }
}

@media (max-width: 480px) {
    .price__grid {
        grid-template-columns: 1fr; /* 1 column on mobile */
        padding: 0; /* Remove extra padding */
    }
    
    .price__card {
        max-width: 350px; /* Increase width of the card on mobile */
        margin: 0 auto; /* Center the card */
    }
}
</style>
<body>
  <nav>
    <div class="nav__logo">
        <a href="#"><img src="logo.png" alt="logo" /></a>
      </div>
      <ul class="nav__links">
      <li class="link"><a href="main.php">Home</a></li>
      <li class="link"><a href="about.php">About</a></li>
      <li class="link"><a href="class.php">Class</a></li>
      <li class="link"><a href="supplements.php">Supplements</a></li>
      <li class="link"><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="menu-toggle" id="mobile-menu">
        <i class="ri-menu-line"></i>
      </div>
    </nav>

<div class="price__container">
    
    <!-- Individuals Plans -->
    <h3>INDIVIDUALS</h3>
    <div class="price__grid">
        <?php
        $individual_plans = $conn->query("SELECT * FROM classes WHERE category='Individuals Plan'");
        while ($plan = $individual_plans->fetch_assoc()) { ?>
            <div class="price__card">
                <h4><?php echo $plan['plan_name']; ?> Plan</h4>
                <h3>$<?php echo $plan['price']; ?></h3>
                <p><?php echo $plan['feature1']; ?></p>
                <p><?php echo $plan['feature2']; ?></p>
                <a href="membership.php?plan=<?php echo strtolower($plan['plan_name']); ?>" class="price__btn">Join Now</a>
            </div>
        <?php } ?>
    </div>

    <!-- Couples Plans -->
    <h3>COUPLES</h3>
    <div class="price__grid">
        <?php
        $couple_plans = $conn->query("SELECT * FROM classes WHERE category='Couples Plan'");
        while ($plan = $couple_plans->fetch_assoc()) { ?>
            <div class="price__card">
                <h4><?php echo $plan['plan_name']; ?> Plan</h4>
                <h3>$<?php echo $plan['price']; ?></h3>
                <p><?php echo $plan['feature1']; ?></p>
                <p><?php echo $plan['feature2']; ?></p>
                <a href="membership.php?plan=<?php echo strtolower($plan['plan_name']); ?>" class="price__btn">Join Now</a>
            </div>
        <?php } ?>
    </div>

    <!-- Students Plans -->
    <h3>STUDENTS</h3>
    <div class="price__grid">
        <?php
        $student_plans = $conn->query("SELECT * FROM classes WHERE category='Students Plan'");
        while ($plan = $student_plans->fetch_assoc()) { ?>
            <div class="price__card">
                <h4><?php echo $plan['plan_name']; ?> Plan</h4>
                <h3>$<?php echo $plan['price']; ?></h3>
                <p><?php echo $plan['feature1']; ?></p>
                <p><?php echo $plan['feature2']; ?></p>
                <a href="membership.php?plan=<?php echo strtolower($plan['plan_name']); ?>" class="price__btn">Join Now</a>
            </div>
        <?php } ?>
    </div>

</div>

</body>
</html>