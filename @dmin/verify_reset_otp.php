<?php
session_start();
include '../upload/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredOtp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
        $_SESSION['otp_verified'] = true; // Mark OTP as verified
        header("Location: reset_password.php"); // Redirect to reset password page
        exit();
    } else {
        echo "<script>alert('Invalid OTP! Try again.'); window.history.back();</script>";
    }
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
        <h2>Verify OTP</h2>
        <form action="" method="POST">
            <label>Enter OTP:</label>
            <input type="text" name="otp" required>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>
