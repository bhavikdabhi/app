<?php
// Database connection
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

include 'db_config.php';

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record from the database
    $sql = "DELETE FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='../@dmin/admin_dashboard.php';</script>";
 
    } else {
        echo "<script>alert('Error deleting record: ');</script>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Invalid request!');</script>";
}

mysqli_close($conn);

exit;
?>
