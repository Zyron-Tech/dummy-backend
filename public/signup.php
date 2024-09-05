<?php
require '../config/db.php';
require '../config/mail.php'; // Ensure mail.php is included for email functionality

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if POST parameters are set
    if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generate OTP and expiry
        $otp = rand(100000, 999999); // Generate a random OTP
        $otpExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP valid for 15 minutes

        // Insert user into the database with OTP and expiry time
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, otp, otp_expiry) VALUES (:username, :password, :email, :otp, :otp_expiry)");
        $result = $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'otp' => $otp,
            'otp_expiry' => $otpExpiry
        ]);

        if ($result) {
            // Send OTP email
            sendOtpEmail($email, $username, $otp); // Implement this function in mail.php

            echo json_encode(['status' => 'success', 'message' => 'Signup successful! Please check your email for the OTP.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register user']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
