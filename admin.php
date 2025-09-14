<?php
session_start();
include 'db.php';

$error = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the login is for admin
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Check if the login is for a regular user
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = true;
                header("Location: main.php");
                exit();
            } else {
                $error = "Invalid credentials!";
            }
        } else {
            $error = "Invalid credentials!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  padding: 15px;
  background: url('front1.png') no-repeat center center/cover;  
  overflow: hidden;
}
.wrapper {
  max-width: 500px;
  width: 100%;
  background: #fff;  
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.1);
}
.wrapper .title {
  height: 120px;
  background:rgba(120, 80, 34, 0.53);  
  border-radius: 5px 5px 0 0;
  color: #fff; 
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form {
  padding: 25px 35px;
}
.wrapper form .row {
  height: 60px;
  margin-top: 15px;
  position: relative;
}
.wrapper form .row input {
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 70px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 18px;
  transition: all 0.3s ease;
}
form .row input:focus {
  border-color:rgb(133, 92, 46);  
}
form .row input::placeholder {
  color: #999;
}
.wrapper form .row i {
  position: absolute;
  width: 55px;
  height: 100%;
  color: #fff;  
  font-size: 22px;
  background:rgb(125, 83, 36); 
  border: 1px solidrgb(110, 77, 39);  
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form .pass {
  margin-top: 12px;
}
.wrapper form .pass a {
  color:rgb(100, 68, 32);  
  font-size: 17px;
  text-decoration: none;
}
.wrapper form .pass a:hover {
  text-decoration: underline;
}
.wrapper form .error {
  color: black;
  font-size: 14px;
  margin-top: 10px;
}
.wrapper form .button input {
  margin-top: 20px;
  color: #fff;  
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background:rgb(101, 69, 33);  
  border: 1px solidrgb(111, 77, 38);  
  cursor: pointer;
}
form .button input:hover {
  background: #d79447;  
}
.wrapper form .signup-link {
  text-align: center;
  margin-top: 45px;
  font-size: 17px;
}
.wrapper form .signup-link a {
  color:rgb(116, 80, 38);  
  text-decoration: none;
}
form .signup-link a:hover {
  text-decoration: underline;
}
</style>
<body>
  <div class="wrapper">
    <div class="title"><span>Login Form</span></div>
    <form method="POST" action="">
      <div class="row">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="row">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <div class="pass"><a href="#">Forgot password?</a></div>
      <?php if ($error) { echo "<div class='error'>$error</div>"; } ?>
      <div class="row button">
        <input type="submit" value="Login" />
      </div>
      <div class="signup-link">Don't have an account? <a href="register.php">Register here</a></div>
    </form>
  </div>
</body>
</html>