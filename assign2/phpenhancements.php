<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Lab 02 Cos10026" />
    <link href="styles/style.css" rel="stylesheet">
    <meta name="keywords" content="Unit Cos10026" />
    <meta name="author" content="Josh Celestino" />
    <title>PHP Enhancements</title>
  </head>
  <body class = "php">
  <section class="navbar">
        <?php include 'nav.inc'; ?>
    </section>
    <h1>PHP Enhancements</h1>
    <h2>Normalization</h2>
    <p>
    Normalization of the skills table from ‘eoi’ table which increases efficiency, <br>
    indexing and helps managers to find specific skills from applicants In this structure, <br>
    the "skills" table contains individual skills associated with each EOInumber and JobReference. <br>
    Each record in the "skills" table will have two foreign keys (EOInumber and JobReference) <br>
    that references the corresponding record in the "eoi" table. <br>
    This allows multiple skills to be associated with either a single EOInumber or JobReference. <br>
    
    </p>
    <h2>Login/Registration Process</h2>
    <p>
    Login/Registration Page with timeout if users failed to input correct credentials 3 times. <br>
    When a user attempts to log in, the code checks if they are currently in a lockout period. <br>
    If so, a lockout message is displayed, preventing further login attempts. <br>
    This is evidenced by the check for the "lockout_start" session variable and the calculation of the remaining time. <br>
    If the user is not in a lockout period, the code retrieves the entered username and password from the form and connects to the database. <br>
    It then compares the entered password with the stored password for the corresponding username. <br>
    If the passwords match, the authentication is successful, and the user is redirected to the management page. <br>
    If the authentication fails, the code keeps track of the login attempts and displays an error message with the remaining attempts. <br>
    If the maximum login attempts are exceeded, the user is locked out for a specified duration. <br>
    This lockout system helps protect against brute-force attacks and enhances the security of the login process. <br>
    </p>

    <h2>Manage.php is not able to be accessed via URL</h2>
    <p class = "end">
    Manage.php is not able to be accessed via URL to prevent malicious users and curious hackers from entering <br>
    into our manage page which contains sensitive information from our database. This is done through <br>
    the use of the superglobal $_SESSION itll see if $_SESSION[“username”] is not nil <br>
    if it is nil itll redirect back to the login page. Once you log out from manage.php $_SESSION[“username”] will become nill. <br>
    </p>
  </body>
</html>
