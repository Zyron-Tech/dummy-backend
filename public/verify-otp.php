<?php
// public/verify-otp.php

require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Fetch user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && $user['otp'] == $otp && $user['otp_expiry'] > date('Y-m-d H:i:s')) {
        // OTP is valid, update user status
        $stmt = $pdo->prepare("UPDATE users SET otp = NULL, otp_expiry = NULL WHERE email = :email");
        $stmt->execute(['email' => $email]);

        echo json_encode(['status' => 'success', 'message' => 'Email verified successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid or expired OTP']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>