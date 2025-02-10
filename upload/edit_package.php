<?php
session_start();
include './db_config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Invalid request!'); window.location.href='admin_dashboard.php';</script>";
    exit;
}
?>

<form action="update_package.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="country" value="<?php echo $row['country']; ?>" required>
    <input type="text" name="place" value="<?php echo $row['place']; ?>" required>
    <textarea name="description" required><?php echo $row['description']; ?></textarea>
    <input type="number" name="day" value="<?php echo $row['day']; ?>" required>
    <input type="number" name="night" value="<?php echo $row['night']; ?>" required>
    <input type="number" name="pax" value="<?php echo $row['pax']; ?>" required>
    <input type="text" name="price" value="<?php echo $row['price']; ?>" required>
    <input type="file" name="image">
    <button type="submit">Update Package</button>
</form>
