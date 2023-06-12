<?php
        require_once("settings.php");

        // Checks if the server is being accessed through a post method (from the form) Or straight from a URL
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to the database and insert the EOI record
                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                // Check for database connection errors
                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                }
            // Sanitize and validate the form data
            $JobReference = mysqli_escape_string($conn, htmlspecialchars($_POST["JobReference"]));
            $FirstName = mysqli_escape_string($conn, htmlspecialchars($_POST["FirstName"]));
            $LastName = mysqli_escape_string($conn, htmlspecialchars($_POST["LastName"]));
            $DateOfBirth = mysqli_escape_string($conn, htmlspecialchars($_POST["DateOfBirth"]));
            $Gender = mysqli_escape_string($conn, htmlspecialchars($_POST["Gender"]));
            $StreetAddress = mysqli_escape_string($conn, htmlspecialchars($_POST["StreetAddress"]));
            $SuburbTown = mysqli_escape_string($conn, htmlspecialchars($_POST["SuburbTown"]));
            $State = mysqli_escape_string($conn, htmlspecialchars($_POST["State"]));
            $Postcode = mysqli_escape_string($conn, htmlspecialchars($_POST["PostCode"]));
            $EmailAddress = mysqli_escape_string($conn, htmlspecialchars($_POST["EmailAddress"]));
            $PhoneNumber = mysqli_escape_string($conn, htmlspecialchars($_POST["PhoneNumber"]));
            $OtherSkills = mysqli_escape_string($conn, htmlspecialchars($_POST["OtherSkills"]));
            $Skill1 = isset($_POST["Skill1"]) ? $_POST["Skill1"] : "";
            $Skill2 = isset($_POST["Skill2"]) ? $_POST["Skill2"] : "";
            $Skill3 = isset($_POST["Skill3"]) ? $_POST["Skill3"] : "";
            $Skill4 = isset($_POST["Skill4"]) ? $_POST["Skill4"] : "";
            $Skill5 = isset($_POST["Skill5"]) ? $_POST["Skill5"] : "";
            $Skill6 = isset($_POST["Skill6"]) ? $_POST["Skill6"] : "";
            $Skill7 = isset($_POST["Skill7"]) ? $_POST["Skill7"] : "";
            // Array Of Required Fields
            $fields = ['JobReference', 'FirstName', 'LastName', 'DateOfBirth', 'Gender', 'StreetAddress', 'SuburbTown', 'State', 'PostCode', 'EmailAddress', 'PhoneNumber'];
            // Creates An Array To Store Empty Fields
            $emptyFields = [];

            // Gets a value of the $fields array and stores it in the $field variable, then checks if that value is empty and if so it puts it in the $emptyFields array
            foreach ($fields as $field) {
                if (empty($_POST[$field])) {
                    $emptyFields[] = $field;
                }
            }
            // Displays Error Message If A field Is Empty
            if (!empty($emptyFields)) {
                echo "<h2>Error:</h2>";
                foreach ($emptyFields as $field) {
                    echo "<p>The $field field is required.</p>";
                }
                    die ("Please Input All Data Fields");
            }

            // Start Of Server Side Validation, making an array to store each error
            $errors = [];

            $JobReference = str_replace(' ', '', $JobReference);
            if (!preg_match("/^[A-Za-z0-9]{5}$/", $JobReference)) {
                $errors[] = "Invalid job reference number format.";
            }
            
            $FirstName = str_replace(' ', '', $FirstName);

            if (!preg_match("/^[A-Za-z]{1,20}$/", $FirstName)) {
                $errors[] = "Invalid first name format.";
            }

            $LastName = str_replace(' ', '', $LastName);
            if (!preg_match("/^[A-Za-z]{1,20}$/", $LastName)) {
                $errors[] = "Invalid last name format.";
            }

            $dobParts = explode('/', $DateOfBirth);
            if (count($dobParts) === 3) {
                $day = $dobParts[0];
                $month = $dobParts[1];
                $year = $dobParts[2];
                if (!checkdate($month, $day, $year)) {
                    $errors[] = "Invalid date of birth.";
                }
            } else {
                $errors[] = "Invalid date of birth format.";
            }

            $validGenders = ['Male', 'Female'];
            if (!in_array($Gender, $validGenders)) {
                $errors[] = "Invalid gender selected.";
            }

            if (strlen(trim($StreetAddress)) > 40) {
                $errors[] = "Street address should not exceed 40 characters.";
            }

            if (strlen(trim($SuburbTown)) > 40) {
                $errors[] = "Suburb/town should not exceed 40 characters.";
            }

            $validStates = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
            if (!in_array($State, $validStates)) {
                $errors[] = "Invalid state selected.";
            } 
    
            if (!preg_match("/^\d{4}$/", $Postcode)) {
                $errors[] = "Invalid postcode format.";
            } elseif ($State == 'VIC' && (($Postcode < 3000 && $Postcode > 3999) || ($Postcode < 8000 && $Postcode > 8999))) {
                $errors[] = "Invalid postcode location." . $Postcode . $State;
            } elseif ($State == 'NSW' && $Postcode < 1000 && $Postcode > 2599) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'QLD' && (($Postcode < 4000 && $Postcode > 4999) || ($Postcode < 9000 && $Postcode > 9999))) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'NT' && (($Postcode < 0800 && $Postcode > 0899) || ($Postcode < 0900 && $Postcode > 0999))) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'WA' && (($Postcode < 6000 && $Postcode > 6797) || ($Postcode < 6800 && $Postcode > 6999))) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'SA' && $Postcode < 5000 && $Postcode > 5999) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'TAS' && (($Postcode < 7000 && $Postcode > 7999) || ($Postcode < 8000 && $Postcode > 8999))) {
                $errors[] = "Invalid postcode location.";
            } elseif ($State == 'ACT' && (($Postcode < 0200 && $Postcode > 0299) || ($Postcode < 2600 && $Postcode > 2618)|| ($Postcode < 2900 && $Postcode > 2920))) {
                $errors[] = "Invalid postcode location.";
            }

            $EmailAddress = str_replace(' ', '', $EmailAddress);
            if (!filter_var($EmailAddress, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email address.";
            }

            $phoneNumber = str_replace(' ', '', $PhoneNumber);
            if (!preg_match("/^\d{8,12}$/", $PhoneNumber)) {
                $errors[] = "Invalid phone number format.";
            }

            if(isset($Skill7) && empty($OtherSkills)){
                $errors[] = "Please Enter Your Other Skills";
            }

            
            if (isset($_POST['Skill1'])){
                $Skill1 = 'True';
            } else {
                $Skill1 = 'False';
            }
            if (isset($_POST['Skill2'])){
                $Skill2 = 'True';
            } else {
                $Skill2 = 'False';
            }
            if (isset($_POST['Skill3'])){
                $Skill3 = 'True';
            } else {
                $Skill3 = 'False';
            }
            if (isset($_POST['Skill4'])){
                $Skill4 = 'True';
            } else {
                $Skill4 = 'False';
            }
            if (isset($_POST['Skill5'])){
                $Skill5 = 'True';
            } else {
                $Skill5 = 'False';
            }
            if (isset($_POST['Skill6'])){
                $Skill6 = 'True';
            } else {
                $Skill6 = 'False';
            }

            // End of Server Side Validation

            // If there is an error(s), it will return the error(s).
            if (count($errors) > 0) {
                echo "<h2>Error:</h2>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }

            } else {
                $DateOfBirth = $dobParts[2] . '-' . $dobParts[1] . '-' . $dobParts[0];
                $createEOITable = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        JobReference VARCHAR(50),
        FirstName VARCHAR(50),
        LastName VARCHAR(50),
        DateOfBirth DATE,
        Gender VARCHAR(10),
        StreetAddress VARCHAR(100),
        SuburbTown VARCHAR(50),
        State VARCHAR(50),
        Postcode VARCHAR(10),
        EmailAddress VARCHAR(100),
        PhoneNumber VARCHAR(20),
        OtherSkills TEXT,
        Status VARCHAR(20)
    )";

    mysqli_query($conn, $createEOITable);

                // Prepare the INSERT statement
                $sqlEOI = "INSERT INTO eoi (JobReference, FirstName, LastName, DateOfBirth, Gender, StreetAddress, SuburbTown, State, Postcode, EmailAddress, PhoneNumber, OtherSkills, Status) 
                        VALUES ('$JobReference', '$FirstName', '$LastName', '$DateOfBirth', '$Gender', '$StreetAddress', '$SuburbTown', '$State', '$Postcode', '$EmailAddress', '$PhoneNumber', '$OtherSkills', 'New')";
               

               
                // Execute the INSERT statement
                if (mysqli_query($conn, $sqlEOI)) {
                // Retrieve the auto-generated EOInumber
                $EOINumber = mysqli_insert_id($conn);

$createSkillsTable = "CREATE TABLE IF NOT EXISTS skills (
             SkillID INT AUTO_INCREMENT PRIMARY KEY,
            EOInumber INT,
            JobReference VARCHAR(5),
            Skill1 ENUM('True', 'False'),
            Skill2 ENUM('True', 'False'),
            Skill3 ENUM('True', 'False'),
            Skill4 ENUM('True', 'False'),
            Skill5 ENUM('True', 'False'),
            Skill6 ENUM('True', 'False'),
            FOREIGN KEY (EOInumber) REFERENCES eoi(EOInumber)
        )";

        mysqli_query($conn, $createSkillsTable);


                $sqlSkills = "INSERT INTO skills (EOINumber,  JobReference, Skill1, Skill2, Skill3, Skill4, Skill5, Skill6) 
                VALUES ('$EOINumber', '$JobReference','$Skill1', '$Skill2', '$Skill3', '$Skill4', '$Skill5', '$Skill6' )";
                
                if(mysqli_query($conn, $sqlSkills)) {
                // Retrieve the Skills Number
                $SkillsNumber = mysqli_insert_id($conn);
                    }
   

        // Display confirmation message to the user
        echo "<h2>Confirmation:</h2>";
        echo "<p>EOI submitted successfully.</p>";
        echo "<p>Your EOInumber is: $EOINumber.</p>";
        echo "<p>Your Skills Number is $SkillsNumber.</p>";
        
    } else {
        echo "Error: " . $sqlEOI . $sqlSkills . "<br>" . mysqli_error($conn);
    }

                // Close the database connection
                mysqli_close($conn);
            }
        } else {
            // Redirects the user to index.html if the form was accessed via URL instead of through the apply page
            header("Location: apply.php");
            exit();
        }


    //Some Functions Used:
    //mysqli_escape_string($conn, $string): This function is used to escape special characters in a string to make it safe for use in an SQL statement.
    //htmlspecialchars($string): This function is used to convert special characters to their corresponding HTML entities. It helps prevent cross-site scripting (XSS) attacks by ensuring that user input is displayed as plain text and not interpreted as HTML or script code.
    //preg_match($pattern, $string): This function is used for pattern matching using regular expressions.
    //checkdate(): This function is used to validate a given date.
    //strlen(): checks the length of the input string
    //trim(): expression is used to remove leading and trailing whitespace (spaces, tabs, etc.)
    //filter_var($string, $parameter): validates and filters various types of data based on predefined or custom filters. 
    //FILTER_VALIDATE_EMAIL: is parameter passed into the $parameter section of filter_var to check if its a valid email
    //in_array(): used to check if a given value exists in an array
    //str_replace('$ReplaceThis', '$WithThis', $String): Replaces a select character/string with another character/string
    //mysqli_connect_error(): This function is used to retrieve the error message from the last MySQL connection attempt.
    //mysqli_query($conn, $sql): This function is used to execute an SQL query on the database. It takes the database connection object ($conn) and the SQL query ($sql) as parameters. It returns true if the query was successful, and false if there was an error.
    //mysqli_insert_id($conn): This function is used to retrieve the auto-generated ID (primary key) that was generated during the last INSERT operation on the database connection specified by $conn.
    //die(message): used to immediately terminate the execution of a script and display a specified message or error to the user.
    //foreach: a loop used to iterate over arrays and objects. Essentailly: while (i < array.length) {
                                                                                                    //Do something 
                                                                                                    //i + 1
                                                                                                    //}
    //explode(): used to split a string into an array of substrings based on a specified delimiter


        ?>
