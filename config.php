<?php
require_once __DIR__ . '/includes/env_loader.php';

// Load .env file
loadEnv(__DIR__ . '/.env');

// Database Configuration
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'shop_db';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// App Configuration
define('APP_URL', getenv('APP_URL') ?: 'http://localhost');
define('PAKASIR_API_KEY', getenv('PAKASIR_API_KEY') ?: '');
define('PAKASIR_PROJECT_SLUG', getenv('PAKASIR_PROJECT_SLUG') ?: '');

session_start();
