<?php
// config/cors.php
header("Access-Control-Allow-Origin: https://zyron-tech.github.io"); // Change '*' to 'https://zyron-tech.github.io' if you want to restrict it to your frontend domain
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
