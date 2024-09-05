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

        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $result = $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email
        ]);

        if ($result) {
            // Send OTP email (update mail.php with actual values)
            // Assume OTP is generated and stored in $otp variable
            $otp = rand(100000, 999999); // Generate a random OTP
            sendOtpEmail($email, $username, $otp); // Implement this function in mail.php

            echo json_encode(['status' => 'success', 'message' => 'Signup successful!']);
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
