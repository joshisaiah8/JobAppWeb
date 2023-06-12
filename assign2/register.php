<?php
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
        $query = "INSERT INTO managers (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        
        // Execute the statement
        $result = mysqli_stmt_execute($stmt);
        
        // Check if the query was successful
        if ($result) {
            echo "<p>Registration successful. Account created!</p>";
        } else {
            echo "<p>Registration failed. Error: " . mysqli_error($conn) . "</p>";
        }
        
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
                    <h2>Create Manager</h2>
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
                        <label for=""><a href="login.php">login</a></label>
                    </div>
                    <button class="Log-inbutton" type="submit">Create Account</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html