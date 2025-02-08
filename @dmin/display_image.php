<?php
// Database connection
include 'db_connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the image data
    $sql = "SELECT image_data FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $imageData);
    mysqli_stmt_fetch($stmt);

    if ($imageData) {
        header("Content-Type: image/jpeg"); // Change if different image format
        echo $imageData;
    } else {
        echo "<script>alert('No image found.');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
