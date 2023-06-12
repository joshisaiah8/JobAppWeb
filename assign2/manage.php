<?php
session_start();
    $username = $_SESSION["username"];

    if (empty($username)){
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    
    <meta name="description" content="Admin">
    <meta name="keywords" content="PHP, MySQL">
    <meta name="author" content="Josh Celestino">
    <title>Admin Page</title>
</head>
<body>

<article id="manageMain">
    <form action="manageProcess.php" method="POST">
        <fieldset>
            <legend>List EOI by Job Reference:</legend>
            <label for="JobReference">Job Reference Number:</label>
            <input type="text" name="JobReference" id="JobReference">
            <input type="submit" value="Search">
        </fieldset>
    </form>

    <form action="manageProcess.php" method="POST">
        <fieldset>
            <legend>List EOI by First/Last Name:</legend>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName">
            <input type="submit" value="Search">
        </fieldset>
    </form>

    <form action="manageProcess.php" method="POST">
        <fieldset>
            <legend>Delete EOI by Job Reference:</legend>
            <label for="deleteJobReference">Job Reference Number:</label>
            <input type="text" name="deleteJobReference" id="deleteJobReference">
            <input type="submit" value="Delete">
        </fieldset>
    </form>

    <form action="manageProcess.php" method="POST">
        <fieldset>
            <legend>Change the Status of an EOI</legend>
            <label for="eoiNumber">EOI Number:</label>
            <input type="text" name="eoiNumber" id="eoiNumber">
            <p>
                <label for="newStatus">Status:</label>
                <select name="newStatus" id="newStatus">
                    <option value="none">Please select</option>
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
            </p>
            <input type="submit" value="Change">
        </fieldset>
    </form>

    <form action="manageProcess.php" method="POST">
        <fieldset>
            <legend>List EOI by based on Skill</legend>
            <p>
                <label for="skill">Skill:</label>
                <select name="skill" id="skill">
                    <option value="none">Please select</option>
                    <option value="Skill1">Communication & Interpersonal</option>
                    <option value="Skill2">Problem Solving Skills</option>
                    <option value="Skill3">Good organisational skills</option>
                    <option value="Skill4">Ability to prioritise tasks</option>
                    <option value="Skill5">Logical approach to work</option>
                    <option value="Skill6">Meticulous attention to detail</option>
                </select>
            </p>
            <input type="submit" value="Find">
        </fieldset>
    </form>

    <form method="POST" action="manageProcess.php">
    <button type="submit" name="displayAllEOIs">Display All EOIs</button>
    </form>

    <form method="POST" action="manageProcess.php">
    <button type="submit" name="Logout">Log out!</button>
    </form>





</article>
</body>
</html>