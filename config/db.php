<?php
// config/db.php

$host = getenv('dpg-crce66lumphs73dkrvs0-a'); // e.g., 'your-database-host.render.com'
$db   = getenv('dummysite_75qn'); // e.g., 'your_database'
$user = getenv('dummysite_75qn_user'); // e.g., 'admin'
$pass = getenv('9rCobo41QicVh4jOm2SoNbMgUk7gH4jQ'); // e.g., 'your_password'

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
