<?php
// Database connection parameters
$host = "localhost"; // Database host
$user = "root"; // Database username
$password = ""; // Database password
$dbname = "msmsdb"; // Database name

// Create a connection
$con = mysqli_connect($host, $user, $password, $dbname);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}
?>
