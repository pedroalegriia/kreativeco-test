<?php

session_start();
header("Content-Type: application/json");
$allowedOrigins = ['http://localhost:8080', 'http://dev.local'];
if (in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config/database.php';
require_once 'middleware.php';
require_once 'services/AuthService.php';
require_once 'routes/api.php';

?>