<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$to = "felixrowan864@gmail.com";
$subject = "Test Mail";
$message = "Hello, this is a test mail";
$from = "hadi.habib315@gmail.com";

// Create a new PHPMailer instance
$mail = new PHPMailer;

// Enable SMTP debugging (optional)
// $mail->SMTPDebug = 2;

// Set up SMTP server settings
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; // You can also use 'ssl'
$mail->Port = 587; // TLS: 587, SSL: 465

$mail->Username = 'your_email@gmail.com'; // Your Gmail email address
$mail->Password = 'your_password'; // Your Gmail password

// Set the sender and recipient email addresses
$mail->setFrom($from);
$mail->addAddress($to);

// Set email subject and message body
$mail->Subject = $subject;
$mail->Body = $message;

// Send the email
if ($mail->send()) {
    echo "Mail sent successfully";
} else {
    echo "Mail sending failed: " . $mail->ErrorInfo;
}
?>
