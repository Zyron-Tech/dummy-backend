<?php
require __DIR__ . '/../vendor/autoload.php'; // Adjust the path as necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOtpEmail($email, $name, $otp) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'markfestus24@gmail.com'; // Your Gmail address
        $mail->Password = 'qrzg snll odez snyg'; // Replace with your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('markfestus24@gmail.com', 'Your Name'); // Adjust sender name
        $mail->addAddress($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = '<p>Your OTP code is: ' . $otp . '</p>';

        // Send email
        $mail->send();
        echo "OTP email sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send OTP email: {$mail->ErrorInfo}";
    }
}
