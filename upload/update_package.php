<?php
include './db_config.php';
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
    $day = $_POST['day'];
    $night = $_POST['night'];
    $pax = $_POST['pax'];
    $price = $_POST['price'];

    // Initialize variables
    $imageData = null;
    $update_image = false;

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $update_image = true;
    }

    // Update query
    if ($update_image) {
        $sql = "UPDATE images SET country = ?, place = ?, description = ?, day = ?, night = ?, pax = ?, price = ?, image_data = ? WHERE id = ?";
    } else {
        $sql = "UPDATE images SET country = ?, place = ?, description = ?, day = ?, night = ?, pax = ?, price = ? WHERE id = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if ($update_image) {
        mysqli_stmt_bind_param($stmt, "sssiiiisi", $country, $place, $description, $day, $night, $pax, $price, $imageData, $id);
    } else {
        mysqli_stmt_bind_param($stmt, "sssiiiis", $country, $place, $description, $day, $night, $pax, $price, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Package updated successfully!'); window.location.href='../@dmin/admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating package: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
