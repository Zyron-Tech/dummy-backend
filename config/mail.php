<?php
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
        $mail->setFrom('markfestus24@gmail.com', 'Dummy Backend'); // Adjust sender name
        $mail->addAddress($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = '<div style="font-family: Arial, sans-serif; text-align: center; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            <h2 style="color: #4CAF50;">Your OTP Code</h2>
            <p style="font-size: 24px; font-weight: bold; color: #333; margin: 10px 0;">' . $otp . '</p>
            <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">
            <p style="font-size: 12px; color: #888;">Credit: <a href="mailto:zyrontech101@gmail.com" style="color: #4CAF50; text-decoration: none;">Zyron-Tech</a></p>
        </div>';

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log error to file
        error_log('Failed to send OTP email: ' . $mail->ErrorInfo);
        return false;
    }
}
?>
