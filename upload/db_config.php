<?php
// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "travel_website";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    echo "Database connection error: " . mysqli_connect_error();
    exit;
}
