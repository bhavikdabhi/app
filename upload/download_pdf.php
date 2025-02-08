<?php
// Database connection

include 'db_config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT pdf FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $pdf_data);
    mysqli_stmt_fetch($stmt);

    if ($pdf_data) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=document.pdf");
        echo $pdf_data;
    } else {
        echo "No PDF available.";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
