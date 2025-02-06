<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);

    try {
     
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bhavikdabhi1101@gmail.com';
        $mail->Password   = 'nwmuliiayziccvgh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

     
        $mail->setFrom('bhavikdabhi1101@gmail.com', 'Tour Inquiry');
        $mail->addAddress('bhavikdabhi1101@gmail.com', 'Admin'); 
        $mail->Subject = 'General Contact Message';
        
       
        $mail->isHTML(true);
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>General Contact Message</title>
        </head>
        <body style='font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;'>
            <table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' style='max-width: 600px; background-color: #ffffff; margin: 20px auto; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                <tr>
                    <td align='center' style='background-color: #0073e6; padding: 20px; color: white; font-size: 24px; font-weight: bold;'>
                       General Contact Message  
                    </td>
                </tr>
                <tr>
                    <td style='padding: 20px;'>
                        <p>Dear Admin,</p>
                        <p>Hi, I’m interested in learning more about your travel packages and destinations. Could you provide me with more details on available tours, pricing, and itineraries? Looking forward to your response! 😊✈️</p>
                        <h3>Contact Details</h3>
                        <table width='100%' border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; text-align: left;'>
                            <tr>
                                <td><strong>Name </strong></td>
                                <td>$name</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>$email</td>
                            </tr>
                            <tr>
                                <td><strong>Message </strong></td>
                                <td>$message</td>
                            </tr>
                        </table>
                        <p>Please respond to the user at your earliest convenience.</p>
                    </td>
                </tr>
                <tr>
                    <td align='center' style='background-color: #0073e6; color: white; padding: 10px; font-size: 14px;'>
                         Quick Support ✉️
                    </td>
                </tr>
            </table>
        </body>
        </html>";

        // Send email
        if ($mail->send()) {
            echo "<script>
                    alert('Your message has been sent successfully!');
                    window.location.href = '../index.php';
                  </script>";
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . addslashes($mail->ErrorInfo) . "');
                window.location.href = '../index.php';
              </script>";
    }
}
?>