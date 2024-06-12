<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Replace with your real receiving email address
$receiving_email_address = 'brandonting.qwe@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                        // Disable verbose debug output
            $mail->isSMTP();                                             // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
            $mail->Username   = 'brandonting.qwe@gmail.com';                  // SMTP username
            $mail->Password   = 'hwur lmsw gjjb pdpo';                     // SMTP password (use App Password if 2FA is enabled)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                     // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($receiving_email_address);                 // Add a recipient

            // Content
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";

            $mail->send();
            echo 'Your message has been sent. Thank you!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
