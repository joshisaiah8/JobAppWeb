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

require_once "settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a connection to the database
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection Failure: " . mysqli_connect_error());
    }

    // Prepare the statement
    $query = "SELECT * FROM managers WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query returned a row
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row["password"];

        // Verify the password
        if ($password == $storedPassword) {
            // Authentication successful
            $_SESSION["username"] = $username;
            $_SESSION["login_attempts"] = isset($_SESSION["login_attempts"]) ? $_SESSION["login_attempts"] + 1 : 0;

            // Redirect to the manage.php page
            header("Location: manage.php");
            exit();
        }
    }

    // Authentication failed
    $_SESSION["login_attempts"] = isset($_SESSION["login_attempts"]) ? $_SESSION["login_attempts"] + 1 : 0;
    $remaining_attempts = 3 - $_SESSION["login_attempts"];

    // Check if the user has exceeded the maximum login attempts
    if ($_SESSION["login_attempts"] >= 3) {
        $lockout_time = 30; // Lockout time in seconds
        $_SESSION["lockout_start"] = time();

        // Display lockout message and redirect to a lockout page
        $_SESSION["login_attempts"] = 0; // Reset login attempts
        header("Location: lockout.php");
        exit();
    }

    // Authentication failed (incorrect credentials)
    echo "<p>Invalid username or password. Remaining attempts: $remaining_attempts</p>";

    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link href="styles/style.css" rel="stylesheet">
    <title>Admin Page</title>
</head>
<body>
    <section class="navbar">
        <?php include 'nav.inc'; ?>
    </section>
    <section class="login-page">
        <div class="form-box">
            <div class="form-value">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h2>Admin</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="">Account</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><a href="register.php">Register</a></label>
                    </div>
                    <button class="Log-inbutton" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
