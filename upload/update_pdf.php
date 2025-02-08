<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

include 'db_config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $country = $_POST['country'];
    $place = $_POST['place'];
    $description = $_POST['description'];

    // Initialize variables
    $pdf_content = null;
    $update_pdf = false;

    // Check if a new PDF is uploaded
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdf_content = file_get_contents($_FILES['pdf']['tmp_name']);
        $update_pdf = true;
    }

    // Update query
    if ($update_pdf) {
        $sql = "UPDATE images SET country = ?, place = ?, description = ?, pdf = ? WHERE id = ?";
    } else {
        $sql = "UPDATE images SET country = ?, place = ?, description = ? WHERE id = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if ($update_pdf) {
        mysqli_stmt_bind_param($stmt, "ssssi", $country, $place, $description, $pdf_content, $id);
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
