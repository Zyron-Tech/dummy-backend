<?php
require '../config/db.php'; // Database connection setup
require '../config/main.php'; // Include main.php if needed for additional setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if POST parameters are set
    if (isset($_POST['email'], $_POST['otp'])) {
        $email = $_POST['email'];
        $otp = $_POST['otp'];

        // Fetch user details
        $stmt = $pdo->prepare("SELECT otp, otp_expiry FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Check if OTP matches and has not expired
            if ($user['otp'] == $otp && $user['otp_expiry'] > date('Y-m-d H:i:s')) {
                // OTP is valid, update user status
                $stmt = $pdo->prepare("UPDATE users SET otp = NULL, otp_expiry = NULL WHERE email = :email");
                $stmt->execute(['email' => $email]);

                echo json_encode(['status' => 'success', 'message' => 'Email verified successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid or expired OTP']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No user found with this email']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
