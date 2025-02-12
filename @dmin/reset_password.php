<?php
session_start();
include '../upload/db_config.php';

if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reset_user'])) {
    echo "<script>alert('Unauthorized access!'); window.location.href='forgot_password.html';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['password'];
    $username = $_SESSION['reset_user'];

    // Validate strong password
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $newPassword)) {
        echo "<script>alert('Weak password! Must include uppercase, lowercase, number, and special character.'); window.history.back();</script>";
        exit();
    }

    // Hash new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update password in database
    $updateQuery = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $username);
    
    if (mysqli_stmt_execute($stmt)) {
        session_destroy();
        echo "<script>alert('Password reset successful! Please log in.'); window.location.href='./admin_login.php';</script>";
    } else {
        echo "<script>alert('Error resetting password!'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WonderlandHoliday</title>
  <link rel="shortcut icon" href="../assets/img/hlogo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./verification.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="" method="POST">
            <label>New Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
