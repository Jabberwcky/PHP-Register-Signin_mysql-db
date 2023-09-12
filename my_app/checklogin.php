<?php
session_start();
include_once 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to server and select database.
$conn = mysqli_connect($host, $username, $password, $db_name);

// Check for connection errors
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$myemail = isset($_POST['myemail']) ? $_POST['myemail'] : '';
$mypassword = isset($_POST['mypassword']) ? $_POST['mypassword'] : '';

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM $tbl_name WHERE email=? AND password=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $myemail, $mypassword);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if a row was returned
if ($row = mysqli_fetch_assoc($result)) {
    // Successful login
    $_SESSION['username'] = $row['username'];
    // Do not store passwords in sessions
    // $_SESSION['password'] = $row['password'];
    echo "true";
} else {
    // Failed login
    echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Wrong Username or Password</div>";
}

// Close the database connection
mysqli_close($conn);
?>
