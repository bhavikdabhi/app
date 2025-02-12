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

    <link rel="stylesheet" href="./verification.css"> <!-- Link to the stylesheet -->
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <form action="register.php" method="POST" onsubmit="return validatePassword()">
            
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Phone:</label>
            <input type="text" name="phone" required>

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" id="password" name="password" required>
            <p id="password-strength"></p>

            <div class="button-group">
    <button type="submit" class="register-btn">Register</button>
    <button type="button" class="go-back-btn" onclick="window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'">
        Go Back
    </button>
</div>


        </form>
    </div>

    <script>
        function validatePassword() {
            let password = document.getElementById("password").value;
            let strength = document.getElementById("password-strength");

            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!regex.test(password)) {
                strength.innerHTML = "Password must be at least 8 characters long and include:<br> 
                                      - Uppercase letter <br> 
                                      - Lowercase letter <br> 
                                      - Number <br> 
                                      - Special character";
                strength.style.color = "red";
                return false;
            }
            return true;
        }
    </script>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Validate password strength (Server-side)
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        echo "<script>alert('Weak password! Must include uppercase, lowercase, number, and special character.'); window.history.back();</script>";
        exit();
    }

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prevent duplicate registration
    $checkQuery = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email or Username already exists!'); window.location.href='register.php';</script>";
        exit();
    }

    // OTP Generation (Prevention Against Brute Force Attacks)
    if (!isset($_SESSION['otp_attempts'])) {
        $_SESSION['otp_attempts'] = 0;
    }
    if ($_SESSION['otp_attempts'] >= 5) {
        echo "<script>alert('Too many OTP requests! Try again later.'); window.history.back();</script>";
        exit();
    }

    $_SESSION['otp_attempts'] += 1;
    $_SESSION['otp'] = rand(100000, 999999);
    $_SESSION['temp_user'] = compact("name", "email", "phone", "username", "hashedPassword");

    // Send OTP via Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bhavikdabhi1101@gmail.com';
        $mail->Password = 'nwmuliiayziccvgh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('bhavikdabhi1101@gmail.com', 'Admin Verification');
        $mail->addAddress($email, $name);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body = "Hello $name,\n\nYour OTP for registration is: {$_SESSION['otp']}\n\nPlease enter this OTP to complete your registration.";

        if ($mail->send()) {
            header("Location: verify_otp.php");
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
