<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gpsc_guider";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if user already exists
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "User already registered. Please login.";
} else {
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, mobile, password) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $fname, $lname, $email, $mobile, $password);
  
  if ($stmt->execute()) {
    echo "Registration successful. You can now <a href='login.html'>login</a>.";
  } else {
    echo "Something went wrong. Try again.";
  }

  $stmt->close();
}

$conn->close();
?>
