<?php
require_once "settings.php";


$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . mysqli_connect_errno()
        . ": " . mysqli_connect_error() . "</p>");
} 


// Function to execute a query and return the results as an array
function executeQuery($conn, $query) {
    $result = mysqli_query($conn, $query);
    return $result;
}


// List all EOIs
function listAllEOIs($conn){
    $query = "SELECT * FROM eoi";
    return executeQuery($conn, $query);
} 

// List EOIs for a particular position (given a job reference number)
function listEOIsByPosition($conn, $jobReference) {
    $query = "SELECT * FROM eoi WHERE JobReference = '$jobReference'";
    return executeQuery($conn, $query);
}

function listEOIsByEOI($conn, $EOI) {
    $query = "SELECT * FROM eoi WHERE EOInumber = '$EOI'";
    return executeQuery($conn, $query);
}



// List EOIs for a particular applicant (given first name, last name, or both)
function listEOIsByApplicant($conn, $firstName, $lastName) {
    $query = "";
    if (!empty($firstName) && !empty($lastName)) {
        $query = "SELECT * FROM eoi WHERE FirstName = '$firstName' AND LastName = '$lastName'";
    } elseif (!empty($firstName) && empty($lastName)) {
        $query = "SELECT * FROM eoi WHERE FirstName = '$firstName'";
    } elseif (!empty($lastName) && empty($firstName)) {
        $query = "SELECT * FROM eoi WHERE LastName = '$lastName'";
    }
    return executeQuery($conn, $query);
} 


function getEOIByJobReference($conn, $jobReference) {
    $jobReference = mysqli_real_escape_string($conn, $jobReference);
    $query = "SELECT * FROM eoi WHERE JobReference = '$jobReference'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $EOIs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $EOIs;
    } else {
        return array(); // Return an empty array if no EOIs found
    }
}


// Delete EOIs with a specified job reference number
function deleteEOIsByJobReference($conn, $jobReference) {
    $jobReference = mysqli_real_escape_string($conn, $jobReference); // Escape the input to prevent SQL injection
    $EOIs = getEOIByJobReference($conn, $jobReference);
    
    $deleteSkillsQuery  = "DELETE FROM skills  WHERE JobReference  = '$jobReference'";
    $deleteSkillsResult = mysqli_query($conn, $deleteSkillsQuery);
    $query = "DELETE FROM eoi WHERE JobReference = '$jobReference'";
    $result = mysqli_query($conn, $query);
    
    if ($result && $deleteSkillsResult ) {
        $deletedRows = mysqli_affected_rows($conn);
        echo "<p>Delete Operation Successful. Deleted " . $deletedRows . " record(s).</p>";
        return true;
    } else {
        
        
        return false;
    }
    
}

// Change the status of an EOI
function changeEOIStatus($conn, $eoinumber, $status) {
    $query = "UPDATE eoi SET status = '$status' WHERE EOInumber = '$eoinumber'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<p>Update operation successful.</p>";
    } else {
        echo "<p>Update operation unsuccessful.</p>";
    }
}

// List EOIs based on skill
function listEOIsByskill($conn, $skillVar) {
    $query = "SELECT * FROM skills WHERE $skillVar = 'True'";
    return executeQuery($conn, $query);
} 


// Adds a button to display all EOIs
echo "<a href=\"manage.php\"><button type=\"button\" >Return!</button></a>";

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the form for listing EOIs by job reference is submitted
    if (isset($_POST["JobReference"])) {
        $jobReference = $_POST["JobReference"];
        $result = listEOIsByPosition($conn, $jobReference);

        // Display the results
        echo "<h2>EOIs for Job Reference: $jobReference</h2>";
        
        if (!$result) {
            echo "<p>Something is wrong with the query: ", mysqli_error($conn), "</p>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n"
                    . "<th scope=\"col\">EOInumber</th>\n"
                    . "<th scope=\"col\">JobReference</th>\n"
                    . "<th scope=\"col\">FirstName</th>\n"
                    . "<th scope=\"col\">LastName</th>\n"
                    . "<th scope=\"col\">DateOfBirth</th>\n"
                    . "<th scope=\"col\">Gender</th>\n"
                    . "<th scope=\"col\">StreetAddress</th>\n"
                    . "<th scope=\"col\">SuburbTown</th>\n"
                    . "<th scope=\"col\">State</th>\n"
                    . "<th scope=\"col\">Postcode</th>\n"
                    . "<th scope=\"col\">EmailAddress</th>\n"
                    . "<th scope=\"col\">PhoneNumber</th>\n"
                    . "<th scope=\"col\">OtherSkills</th>\n"
                    . "<th scope=\"col\">Status</th>\n"
                    . "</tr>\n";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", $row["EOInumber"], "</td>\n";
                    echo "<td>", $row["JobReference"], "</td>\n";
                    echo "<td>", $row["FirstName"], "</td>\n";
                    echo "<td>", $row["LastName"], "</td>\n";
                    echo "<td>", $row["DateOfBirth"], "</td>\n";
                    echo "<td>", $row["Gender"], "</td>\n";
                    echo "<td>", $row["StreetAddress"], "</td>\n";
                    echo "<td>", $row["SuburbTown"], "</td>\n";
                    echo "<td>", $row["State"], "</td>\n";
                    echo "<td>", $row["Postcode"], "</td>\n";
                    echo "<td>", $row["EmailAddress"], "</td>\n";
                    echo "<td>", $row["PhoneNumber"], "</td>\n";
                    echo "<td>", $row["OtherSkills"], "</td>\n";
                    echo "<td>", $row["Status"], "</td>\n";
                    echo "</tr>\n";
                }

                echo "</table>\n";
            } else {
                echo "<p>No records found</p>";
            }
        } 
    }
    
    // Check if the form for listing EOIs by first/last name is submitted
    if (isset($_POST["firstName"]) || isset($_POST["lastName"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $result = listEOIsByApplicant($conn, $firstName, $lastName);
        
        
        // Display the results
        echo "<h2>EOIs for Applicant: $firstName $lastName</h2>";
        
        if (!$result) {
            echo "<p>Something is wrong with the query: ", mysqli_error($conn), "</p>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n"
                    . "<th scope=\"col\">EOINumber</th>\n"
                    . "<th scope=\"col\">JobReference</th>\n"
                    . "<th scope=\"col\">FirstName</th>\n"
                    . "<th scope=\"col\">LastName</th>\n"
                    . "<th scope=\"col\">DateOfBirth</th>\n"
                    . "<th scope=\"col\">Gender</th>\n"
                    . "<th scope=\"col\">StreetAddress</th>\n"
                    . "<th scope=\"col\">SuburbTown</th>\n"
                    . "<th scope=\"col\">State</th>\n"
                    . "<th scope=\"col\">Postcode</th>\n"
                    . "<th scope=\"col\">EmailAddress</th>\n"
                    . "<th scope=\"col\">PhoneNumber</th>\n"
                    . "<th scope=\"col\">OtherSkills</th>\n"
                    . "<th scope=\"col\">Status</th>\n"
                    . "</tr>\n";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", $row["EOInumber"], "</td>\n";
                    echo "<td>", $row["JobReference"], "</td>\n";
                    echo "<td>", $row["FirstName"], "</td>\n";
                    echo "<td>", $row["LastName"], "</td>\n";
                    echo "<td>", $row["DateOfBirth"], "</td>\n";
                    echo "<td>", $row["Gender"], "</td>\n";
                    echo "<td>", $row["StreetAddress"], "</td>\n";
                    echo "<td>", $row["SuburbTown"], "</td>\n";
                    echo "<td>", $row["State"], "</td>\n";
                    echo "<td>", $row["Postcode"], "</td>\n";
                    echo "<td>", $row["EmailAddress"], "</td>\n";
                    echo "<td>", $row["PhoneNumber"], "</td>\n";
                    echo "<td>", $row["OtherSkills"], "</td>\n";
                    echo "<td>", $row["Status"], "</td>\n";
                    echo "</tr>\n";
                }

                echo "</table>\n";
            } else {
                echo "<p>No records found</p>";
            }
        } 

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteJobReference"])) {
    $jobReference = $_POST["deleteJobReference"];
    deleteEOIsByJobReference($conn, $jobReference);
    }

    if (isset($_POST["eoiNumber"]) && isset($_POST["newStatus"])) {
        $eoinumber = $_POST["eoiNumber"];
        $status = $_POST["newStatus"];
        changeEOIStatus($conn, $eoinumber, $status);
    }

    if (isset($_POST["skill"])) {
        $skillVar = $_POST["skill"];
        $result = listEOIsByskill($conn, $skillVar);
        $eoi =  [];
        $index = 0;
        if (!$result) {
            echo "<p>Something is wrong with the query: ", mysqli_error($conn), "</p>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n"
                    . "<th scope=\"col\">EOInumber</th>\n"
                    . "<th scope=\"col\">Communication & interpersonal</th>\n"
                    . "<th scope=\"col\">Problem Solving skills</th>\n"
                    . "<th scope=\"col\">Good organisational skills</th>\n"
                    . "<th scope=\"col\">Ability to prioritise tasks</th>\n"
                    . "<th scope=\"col\">Logical approach to work</th>\n"
                    . "<th scope=\"col\">Meticulous attention to detail</th>\n"
                    . "</tr>\n";

                while ($row = mysqli_fetch_assoc($result)) {
                    
                    echo "<tr>\n";
                    echo "<td>", $row["EOInumber"], "</td>\n";
                    echo "<td>", $row["Skill1"], "</td>\n";
                    echo "<td>", $row["Skill2"], "</td>\n";
                    echo "<td>", $row["Skill3"], "</td>\n";
                    echo "<td>", $row["Skill4"], "</td>\n";
                    echo "<td>", $row["Skill5"], "</td>\n";
                    echo "<td>", $row["Skill6"], "</td>\n";
                    echo "</tr>\n";
                    $eoi[$index] = $row["EOInumber"];
                    $index += 1;
                    
                }
                echo "</table>\n";
                $index = 0;
                foreach ($eoi as $EOI){
                    
                    $result = listEOIsByEOI($conn, $EOI);
                    if (mysqli_num_rows($result) > 0) {
                    echo "<table border=\"1\">\n";
                    echo "<tr>\n"
                        . "<th scope=\"col\">EOINumber</th>\n"
                        . "<th scope=\"col\">JobReference</th>\n"
                        . "<th scope=\"col\">FirstName</th>\n"
                        . "<th scope=\"col\">LastName</th>\n"
                        . "<th scope=\"col\">DateOfBirth</th>\n"
                        . "<th scope=\"col\">Gender</th>\n"
                        . "<th scope=\"col\">StreetAddress</th>\n"
                        . "<th scope=\"col\">SuburbTown</th>\n"
                        . "<th scope=\"col\">State</th>\n"
                        . "<th scope=\"col\">Postcode</th>\n"
                        . "<th scope=\"col\">EmailAddress</th>\n"
                        . "<th scope=\"col\">PhoneNumber</th>\n"
                        . "<th scope=\"col\">OtherSkills</th>\n"
                        . "<th scope=\"col\">Status</th>\n"
                        . "</tr>\n";
    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>\n";
                        echo "<td>", $row["EOInumber"], "</td>\n";
                        echo "<td>", $row["JobReference"], "</td>\n";
                        echo "<td>", $row["FirstName"], "</td>\n";
                        echo "<td>", $row["LastName"], "</td>\n";
                        echo "<td>", $row["DateOfBirth"], "</td>\n";
                        echo "<td>", $row["Gender"], "</td>\n";
                        echo "<td>", $row["StreetAddress"], "</td>\n";
                        echo "<td>", $row["SuburbTown"], "</td>\n";
                        echo "<td>", $row["State"], "</td>\n";
                        echo "<td>", $row["Postcode"], "</td>\n";
                        echo "<td>", $row["EmailAddress"], "</td>\n";
                        echo "<td>", $row["PhoneNumber"], "</td>\n";
                        echo "<td>", $row["OtherSkills"], "</td>\n";
                        echo "<td>", $row["Status"], "</td>\n";
                        echo "</tr>\n";
                    }
                    echo "</table>\n";
            } else {
                echo "<p>No records found</p>";
            }
                }

            }   
            
        } 
    } 
    if (isset($_POST["Logout"])) {
        session_start();
        $_SESSION["username"] = "";
        session_destroy();
        header("Location: login.php");
        exit();
    }
    

    if (isset($_POST["displayAllEOIs"])) {
        $result = listAllEOIs($conn);
        
        // Display the results
        echo "<h2>All EOIs</h2>";
        
        if (!$result) {
            echo "<p>Something is wrong with the query: ", mysqli_error($conn), "</p>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n"
                    . "<th scope=\"col\">EOINumber</th>\n"
                    . "<th scope=\"col\">JobReference</th>\n"
                    . "<th scope=\"col\">FirstName</th>\n"
                    . "<th scope=\"col\">LastName</th>\n"
                    . "<th scope=\"col\">DateOfBirth</th>\n"
                    . "<th scope=\"col\">Gender</th>\n"
                    . "<th scope=\"col\">StreetAddress</th>\n"
                    . "<th scope=\"col\">SuburbTown</th>\n"
                    . "<th scope=\"col\">State</th>\n"
                    . "<th scope=\"col\">Postcode</th>\n"
                    . "<th scope=\"col\">EmailAddress</th>\n"
                    . "<th scope=\"col\">PhoneNumber</th>\n"
                    . "<th scope=\"col\">OtherSkills</th>\n"
                    . "<th scope=\"col\">Status</th>\n"
                    . "</tr>\n";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", $row["EOInumber"], "</td>\n";
                    echo "<td>", $row["JobReference"], "</td>\n";
                    echo "<td>", $row["FirstName"], "</td>\n";
                    echo "<td>", $row["LastName"], "</td>\n";
                    echo "<td>", $row["DateOfBirth"], "</td>\n";
                    echo "<td>", $row["Gender"], "</td>\n";
                    echo "<td>", $row["StreetAddress"], "</td>\n";
                    echo "<td>", $row["SuburbTown"], "</td>\n";
                    echo "<td>", $row["State"], "</td>\n";
                    echo "<td>", $row["Postcode"], "</td>\n";
                    echo "<td>", $row["EmailAddress"], "</td>\n";
                    echo "<td>", $row["PhoneNumber"], "</td>\n";
                    echo "<td>", $row["OtherSkills"], "</td>\n";
                    echo "<td>", $row["Status"], "</td>\n";
                    echo "</tr>\n";
                }

                echo "</table>\n";
            } else {
                echo "<p>No records found</p>";
            }
        } 
    }
} else {
    header("Location: manage.php");
    exit();
}


    // Check if the form for deleting EOIs by job reference is submitted
    
    


    // Check if the form for changing the status of an EOI is submitted
    

    // Check if the form for listing EOIs by skill is submitted
    


    // listing all EOIs


?>
    