<?php
session_start();

// Check if the user is currently in a lockout period
if (isset($_SESSION["lockout_start"])) {
    $lockout_time = 30; // Lockout time in seconds
    $remaining_time = $_SESSION["lockout_start"] + $lockout_time - time();

    if ($remaining_time > 0) {
        // Display the lockout message
        echo "<p>You have been locked out. Please try again after $remaining_time seconds.</p>";
        exit();
    }
}

// Redirect to the login page if the user is not in a lockout period
header("Location: login.php");
exit();
?>
