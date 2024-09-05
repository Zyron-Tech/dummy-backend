<?php
// public/signup.php

require '../config/db.php';
require '../config/mail.php'; // Include Brevo configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    
    // Generate OTP
    $otp = rand(100000, 999999);
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP valid for 15 minutes

    // Save user details with OTP in the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, otp, otp_expiry) VALUES (:username, :password, :email, :otp, :otp_expiry)");
    $stmt->execute([
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'otp' => $otp,
        'otp_expiry' => $otp_expiry
    ]);

    // Send OTP to user email
    sendOtpEmail($email, $otp);

    echo json_encode(['status' => 'success', 'message' => 'Signup successful! Please check your email for OTP verification.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
