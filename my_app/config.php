<?php
$host = 'login.cvh7jku5mpbh.ap-south-1.rds.amazonaws.com'; // Host name
$username = 'root'; // Mysql username
$password = '123456789'; // Mysql password
$port = '3306'; // Port number
$db_name = 'login'; // Database name
$tbl_name = 'members'; // Table name

// Create a connection
$conn = mysqli_connect($host, $username, $password, $db_name, $port);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
if (!mysqli_select_db($conn, $db_name)) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
