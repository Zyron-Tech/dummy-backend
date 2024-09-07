<?php
// public/login.php

// Include the database connection file
require '../config/db.php';
// This is for the CORS error fix
require '../config/cors.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute the SQL statement
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Verify the user password
        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
