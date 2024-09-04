<?php
// config/db.php

$host = getenv('DB_HOST'); // e.g., 'db.your-render-service.com'
$db   = getenv('DB_NAME'); // e.g., 'your_database'
$user = getenv('DB_USER'); // e.g., 'your_username'
$pass = getenv('DB_PASS'); // e.g., 'your_password'

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
