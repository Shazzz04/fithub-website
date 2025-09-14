<?php
session_start();
include 'db_supplements.php';

$plan = isset($_GET['plan']) ? $_GET['plan'] : '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $location = $_POST['location'];
  $plan = $_POST['plan'];

  // Save membership details to the database
  $stmt = $conn->prepare("INSERT INTO memberships (first_name, last_name, email, phone, location, plan) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $location, $plan);
  $stmt->execute();
  $stmt->close();

  // Set success message
  $successMessage = "Thank you, $firstName $lastName! Your membership request for the $plan plan has been received. Our support team will contact you soon.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Membership</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      background-image: url('front7.png'); /* Add your image URL here */
      background-size: cover; /* Ensure the image covers the whole page */
      background-position: center; /* Center the image */
      background-attachment: fixed; /* Make the background image fixed during scrolling */
      background-repeat: no-repeat; /* Prevent image from repeating */
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }
    .container {
      width: 80%;
      max-width: 600px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      font-size: 2rem;
    }
    form input, form select {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    form button {
      background:rgb(174, 154, 39);
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
      margin: 10px;
    }
    form button:hover {
      background:rgba(145, 134, 33, 0.68);
    }
    .success-message {
      background:rgba(153, 130, 26, 0.51);
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      margin-top: 20px;
      display: none;
    }
    .back-button {
      background:rgb(185, 145, 34); /* Green background */
      color: #fff; /* White text */
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
      margin: 10px;
    }
    .back-button:hover {
      background:rgba(143, 145, 33, 0.48); /* Darker green on hover */
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Join the <?php echo ucfirst($plan); ?> Plan</h2>
    <form id="membershipForm" method="POST" action="membership.php">
      <input type="hidden" name="plan" value="<?php echo $plan; ?>">
      <input type="text" name="firstName" placeholder="First Name" required>
      <input type="text" name="lastName" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <select name="location" required>
        <option value="">Select Location</option>
        <option value="Kaduwela">Kaduwela</option>
        <option value="Malabe">Malabe</option>
        <option value="Nugegoda">Nugegoda</option>
      </select>
      <button type="submit">Submit</button>
      <a href="class.php" class="back-button">Back to Classes</a>
    </form>
    <div class="success-message" id="successMessage"><?php echo isset($successMessage) ? $successMessage : ''; ?></div>
  </div>

  <script>
    // Show success message if it exists
    const successMessage = "<?php echo isset($successMessage) ? $successMessage : ''; ?>";
    if (successMessage) {
      document.getElementById('successMessage').style.display = 'block';
    }
  </script>
</body>
</html>

<?php
$conn->close();
?>