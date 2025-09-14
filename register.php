<?php
session_start();
include 'db.php';

$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $success_message = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $success_message = "Username already exists! You can <a href='admin.php'>login here</a>.";
        } else {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, phone, password, gender) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $fullname, $username, $email, $phone, $hashed_password, $gender);
            $stmt->execute();
            $success_message = "Registration successful! You can now <a href='admin.php'>login</a>.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;700&display=swap">
    <link rel="stylesheet" href="main.css">
</head>
<style>
/* Importing Google Fonts - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background-image: url('front1.png'); /* Add your image URL here */
  background-size: cover; /* Ensure the image covers the whole page */
  background-position: center; /* Center the image */
  background-attachment: fixed; /* Make the background image fixed during scrolling */
  background-repeat: no-repeat; /* Prevent image from repeating */
  font-family: 'Poppins', sans-serif;}
.container {
  max-width: 700px;
  width: 100%;
  background-color: #1f2125; /* Dark background */
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}
.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
  color: #f9ac54; /* Orange color */
}
.container .title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: #f9ac54; /* Orange color */
}
.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box {
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
  color: #fff; /* White color */
}
.user-details .input-box input {
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
  background: #35373b; /* Dark background */
  color: #fff; /* White color */
}
.user-details .input-box input:focus,
.user-details .input-box input:valid {
  border-color: #f9ac54; /* Orange color */
}
form .gender-details .gender-title {
  font-size: 20px;
  font-weight: 500;
  color: #fff; /* White color */
}
form .category {
  display: flex;
  width: 80%;
  margin: 14px 0;
  justify-content: space-between;
}
form .category label {
  display: flex;
  align-items: center;
  cursor: pointer;
  color: #fff; /* White color */
}
form .category label .dot {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
#dot-1:checked~.category label .one,
#dot-2:checked~.category label .two,
#dot-3:checked~.category label .three {
  background: #f9ac54; /* Orange color */
  border-color: #d9d9d9;
}
form input[type="radio"] {
  display: none;
}
form .button {
  height: 45px;
  margin: 35px 0
}
form .button input {
  height: 100%;
  width: 100%;
  border-radius: 5px;
  border: none;
  color: #111317; /* Black color */
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s ease;
  background: #f9ac54; /* Orange color */
}
form .button input:hover {
  background: #d79447; /* Darker orange on hover */
}
/* Style for the success message */
.success-message {
    margin-top: 1rem;
    color: #f9ac54; /* Orange color */
    font-weight: 500;
}

/* Style for the login link within the success message */
.success-message a {
    color: #fff; /* White color */
    text-decoration: underline;
}

.success-message a:hover {
    color: #d9d9d9; /* Light grey color on hover */
}
/* Responsive media query code for mobile devices */
@media(max-width: 584px) {
  .container {
    max-width: 100%;
  }
  form .user-details .input-box {
    margin-bottom: 15px;
    width: 100%;
  }
  form .category {
    width: 100%;
  }
  .content form .user-details {
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar {
    width: 5px;
  }
}
/* Responsive media query code for mobile devices */
@media(max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
}
</style>
<body>
    <div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <form method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="fullname" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1" value="Male">
                    <input type="radio" name="gender" id="dot-2" value="Female">
                    <input type="radio" name="gender" id="dot-3" value="Prefer not to say">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register">
                </div>
            </form>
            <?php if ($success_message): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>