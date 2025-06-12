<?php
session_start();
session_unset();  // Optional: clears session variables
session_destroy();  // Destroys the session

header("Location: login.html");
exit();
?>