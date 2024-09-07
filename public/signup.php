<?php
require '../config/db.php';
require '../config/mail.php'; // Ensure mail.php is included for email functionality
require '../config/cors.php'; // CORS fix

header('Content-Type: application/json'); // Ensure the content type is always JSON

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
        $otpExpiry = date('Y-m-d H:i:s', strtotime('+30 minutes')); // OTP valid for 30 minutes

        try {
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
                if (sendOtpEmail($email, $username, $otp)) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Signup successful! Please check your email for the OTP.'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Signup successful but failed to send OTP email.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to register user.'
                ]);
            }
        } catch (PDOException $e) {
            // Check for unique constraint violation (duplicate email)
            if ($e->getCode() == 23505) { // PostgreSQL error code for unique violation
                echo json_encode([
                    'status' => 'error',
                    'message' => 'This email is already registered. Please log in or use a different email.'
                ]);
            } else {
                // General error message
                echo json_encode([
                    'status' => 'error',
                    'message' => 'An unexpected error occurred. Please try again.'
                ]);
            }
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing required fields.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}
?>
