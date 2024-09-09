<?php
// public/delete_account.php

// Include necessary files
require '../config/db.php';        // Database connection
require '../config/cors.php';      // CORS settings

// Set the response header to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if POST parameters are set
    if (isset($_POST['email'], $_POST['password'])) {
        // Get and sanitize user input
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        try {
            // Fetch the user from the database by email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // Check if user exists and the password is correct
            if ($user && password_verify($password, $user['password'])) {
                // Prepare delete statement
                $deleteStmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
                $deleteResult = $deleteStmt->execute(['email' => $email]);

                // Check if the deletion was successful
                if ($deleteResult) {
                    echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to delete account. Please try again.']);
                }
            } else {
                // Invalid credentials
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials.']);
            }
        } catch (PDOException $e) {
            // Handle any database errors
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        // Missing required fields
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    }
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
