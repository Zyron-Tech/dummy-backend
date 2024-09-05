<?php
// config/db.php

$host = 'dpg-crce66lumphs73dkrvs0-a.oregon-postgres.render.com';
$port = '5432';
$dbname = 'dummysite_75qn';
$user = 'dummysite_75qn_user';
$password = '9rCobo41QicVh4jOm2SoNbMgUk7gH4jQ';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
