<html>
<head>
<title>Task 5 - Search Status Result Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
div.status {
	border-style: solid;
	border-color: navy;
}
</style>
</head>

<body>
	<h1 align="center">Status Information</h1>
	
<?php
require_once ("../../conf/settings.php");

$conn = @mysqli_connect($host, $user, $pswd, $dbnm);

// Checks if connection is successful
if (! $conn) {
    // Displays an error message
    echo "<p>Database connection failure</p><br>";
    echo "<a href = 'searchstatusform.php'>Search for another status</a>";
    echo "<a href = 'index.html' style= 'float:right;'>Return to Home Page</a>";
} 
else {
    // check if the table exists
    $query = "SHOW TABLES LIKE 'status'";
    $result = @mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "The status table has existed in the database.<br><br>";
        
        // Get data from the form
        $status = $_GET["status"];
        
        // Set up the SQL command to retrieve the data from the table
        $query = "select * from status where Status like '%$status%'";
        $result = mysqli_query($conn, $query);
        
        if (! $result) {
            echo "Somthing wrong with the query.<br>";
            echo "<a href = 'searchstatusform.php'>Search for another status</a>";
            echo "<a href = 'index.html' style= 'float:right;'>Return to Home Page</a>";
        } 
        else {
            // validate search string, check if user enter valid Status.
            $statusPattern = "/[A-Za-z0-9 ,.!?]+/";
            if (! preg_match($statusPattern, $status)) {
                echo "Please enter valid Status.<br>";
            } 
            else {
                // validate search string, check if the searched status exists in the table.
                if (mysqli_num_rows($result) < 1) {
                    echo "Oops! There is not this status, please search other status.<br><br>";
                } 
                else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='status'><p>Status: ", $row["Status"], "</p>";
                        echo "<p>Status Code: ", $row["StatusCode"], "</p>";
                        echo "<p>Share: ", $row["Share"], "</p>";
                        echo "<p>Date Posted: ", $row["Date"], "</p>";
                        echo "<p>Permission: ", $row["PermissionType"], "</p></div><br>";
                    }
                }
            }
            
            // Frees up the memory, after using the result pointer
            mysqli_free_result($result);
            
            // close the database connection
            mysqli_close($conn);
            
            echo "<div style='margin-left:20px'><a href = 'searchstatusform.php'>Search for another status</a>";
            echo "<a href = 'index.html' style= 'float:right;'>Return to Home Page</a></div>";
        }
    }    
    // provide a error message if the status table does not exist.
    else {
        echo "The status table does not exist.<br>";
        echo "<a href = 'searchstatusform.php'>Search for another status</a>";
        echo "<a href = 'index.html' style= 'float:right;'>Return to Home Page</a>";
    }
}

?>
	
</body>
</html>