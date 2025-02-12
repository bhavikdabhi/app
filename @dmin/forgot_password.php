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
        <h2>Forgot Password</h2>
        <form action="#" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Phone Number:</label>
            <input type="text" name="phone" required>

            <button type="submit">Confirm</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

include_once '../upload/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Check if the user exists
    $query = "SELECT email FROM users WHERE username = ? AND phone = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<script>alert('Invalid username or phone number!'); window.history.back();</script>";
        exit();
    }

    $email = $user['email'];

    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['reset_user'] = $username;

    // Send OTP via Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bhavikdabhi1101@gmail.com';  // Replace with your email
        $mail->Password = 'nwmuliiayziccvgh';  // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('bhavikdabhi1101@gmail.com', 'Password Reset');
        $mail->addAddress($email, $username);
        $mail->Subject = 'Your OTP for Password Reset';
        $mail->Body = "Hello $username,\n\nYour OTP for password reset is: $otp\n\nPlease enter this OTP to reset your password.";

        if ($mail->send()) {
            header("Location: verify_reset_otp.php"); // Redirect to OTP verification page
            exit();
        } else {
            echo "<script>alert('OTP email sending failed!'); window.history.back();</script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>alert('Mail Error: " . $mail->ErrorInfo . "'); window.history.back();</script>";
        exit();
    }
}
?>
