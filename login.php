<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "gpsc_guider";

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Email not found — redirect to register page
        header("Location: register.html");
        exit();
    } else {
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] = $password) {
            $_SESSION['email'] = $email;
            header("Location: dashboard.html"); // Successful login
            exit();
        } else {
            // Password is wrong — show alert and go back
            echo "<script>
            alert('Incorrect password. Please try again.'); window.location.href='login.html';
            </script>";
        }
    }
}
?>
