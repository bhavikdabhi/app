<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $country = $_POST['country'];
    $place = $_POST['place'];
    $description = $_POST['description'];

    // Initialize variables
    $imageData = null;
    $update_image = false;

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']); // Convert image to binary
        $update_image = true;
    }

    // Update query
    if ($update_image) {
        $sql = "UPDATE images SET country = ?, place = ?, description = ?, image_data = ? WHERE id = ?";
    } else {
        $sql = "UPDATE images SET country = ?, place = ?, description = ? WHERE id = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if ($update_image) {
        mysqli_stmt_bind_param($stmt, "ssssi", $country, $place, $description, $imageData, $id);
    } else {
        mysqli_stmt_bind_param($stmt, "sssi", $country, $place, $description, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

// Redirect back to view page
header("Location: ../@dmin/admin_dashboard.php");
exit;
?>
