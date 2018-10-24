<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Task 3 - Process Post Status Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<h1 align="center">Status Posting System</h1>

<?php

/*
 * Get data from the form, scode refers to status code
 * , ptype refers to permission type.
 */
$scode = $_POST["scode"];
$status = $_POST["status"];
$share = $_POST["share"];
$date = $_POST["date"];
$ptypeArray = $_POST["ptype"];
$ptype = implode(", ", $ptypeArray);

// check if user enter valid Status Code
if (! empty($scode)) {
    $codePattern = "/^S\d\d\d\d$/";
    if (preg_match($codePattern, $scode)) {
        
        // check if user enter valid Status
        if (! empty($status)) {
            $statusPattern = "/[A-Za-z0-9 ,.!?]+/";
            if (preg_match($statusPattern, $status)) {
                
                $datePattern = "/^[0-3][0-9].[0-1][0-9].(?:[0-9]{2})?[0-9]{2}$/";
                if (preg_match($datePattern, $date)) {
                    require_once ("../../conf/settings.php");
                    $conn = @mysqli_connect($host, $user, $pswd, $dbnm) or die("Failed to connect to DB");
                    
                    // check if the table exists
                    $query = "SHOW TABLES LIKE 'status'";
                    $result = @mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "The table has existed in the database.";
                    }                    
                    // create table, if there is no table.
                    else {
                        // Frees up the memory, after using the result pointer
                        mysqli_free_result($result);
                        
                        $query = "CREATE TABLE status (StatusCode VARCHAR(255)
        			  , Status VARCHAR(255), Share VARCHAR(255), Date VARCHAR(255), PermissionType VARCHAR(255)
        			  , PRIMARY KEY (StatusCode) )";
                        
                        $result = @mysqli_query($conn, $query);
                        
                        // Frees up the memory, after using the result pointer
                        mysqli_free_result($result);
                        echo "A new table is created.";
                    }
                    
                    // Set up the SQL command to add the data into the table
                    $query = "insert into status" . "(StatusCode, Status, Share, Date, PermissionType)" . "values" . "('$scode','$status','$share', '$date','$ptype')";
                    
                    // executes the query
                    $result = mysqli_query($conn, $query);
                    // checks if the execution was successful
                    if (! $result) {
                        echo "<p>Please enter unique Status Code.</p>";
                        echo "<div style='margin-left:20px'><a href='index.html'>Return to Home page</a><br>";
                        echo "<a href='poststatusform.php'>Return to Post status page</a></div>";
                    } else {
                        // display an operation successful message, if successful query operation
                        echo "<p>Congratulations! The status has been stored successfully in the database.</p><br>";
                        echo "<div style='margin-left:20px'><a href='index.html'>Return to Home page</a></div>";
                    }
                    
                    // Frees up the memory, after using the result pointer
                    mysqli_free_result($result);
                    
                    // close the database connection
                    mysqli_close($conn);
                }                
                /*
                 * provide error messages to user that includes links to return
                 * to the Home page and Post Status page.
                 */
                else {
                    echo "Date must conform to the dd/mm/yyyy format.<br>";
                    echo "<a href='index.html'>Return to Home page</a><br>";
                    echo "<a href='poststatusform.php'>Return to Post status page</a>";
                }
            } else {
                echo "Please enter valid Status.<br>";
                echo "<a href='index.html'>Return to Home page</a><br>";
                echo "<a href='poststatusform.php'>Return to Post status page</a>";
            }
        } else {
            echo "Please enter Status.<br>";
            echo "<a href='index.html'>Return to Home page</a><br>";
            echo "<a href='poststatusform.php'>Return to Post status page</a>";
        }
    } else {
        echo "Please enter valid Status Code. e.g. S0001<br>";
        echo "<a href='index.html'>Return to Home page</a><br>";
        echo "<a href='poststatusform.php'>Return to Post status page</a>";
    }
} else {
    echo "Please enter Status Code.<br>";
    echo "<a href='index.html'>Return to Home page</a><br>";
    echo "<a href='poststatusform.php'>Return to Post status page</a>";
}

?>

</body>
</html>
