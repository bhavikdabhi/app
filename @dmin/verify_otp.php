<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../@dmin/admin_login.php");
    exit;
}


include '../upload/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredOtp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
        $user = $_SESSION['temp_user'];
        $insertQuery = "INSERT INTO users (name, email, phone, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sssss", $user['name'], $user['email'], $user['phone'], $user['username'], $user['hashedPassword']);

        if (mysqli_stmt_execute($stmt)) {
            unset($_SESSION['otp']);
            unset($_SESSION['temp_user']);
            echo "<script>alert('Registration Successful!'); window.location.href='admin_login.php';</script>";
        } else {
            echo "<script>alert('Error registering user!'); window.history.back();</script>";
        }

        mysqli_stmt_close($stmt);
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
        <form action="verify_otp.php" method="POST">
            <label>Enter OTP:</label>
            <input type="text" name="otp" required>
            <div class="button-group">
            <button type="submit">Verify</button>
            <button type="button" class="go-back-btn" onclick="window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'">
        Go Back
    </button>
</div>
        </form>
    </div>
</body>
</html>
