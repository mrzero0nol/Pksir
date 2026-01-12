<?php
// install/process.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$host = $_POST['host'] ?? 'localhost';
$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';
$name = $_POST['name'] ?? '';
$base_url = $_POST['base_url'] ?? 'http://localhost';

if (empty($host) || empty($user) || empty($name)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// 1. Test Connection
try {
    $dsn = "mysql:host=$host;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Create DB if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name`");
    $pdo->exec("USE `$name`");

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// 2. Import SQL
require_once 'sql_import.php';
$importer = new SqlImport($pdo);
if (!$importer->import('../sql/database.sql')) {
     echo json_encode(['success' => false, 'message' => 'Failed to import SQL schema']);
     exit;
}

// 3. Write .env
$envContent = "DB_HOST=$host\n";
$envContent .= "DB_NAME=$name\n";
$envContent .= "DB_USER=$user\n";
$envContent .= "DB_PASS=$pass\n";
$envContent .= "BASE_URL=$base_url\n";
$envContent .= "APP_ENV=production\n";

if (file_put_contents('../.env', $envContent)) {
    echo json_encode(['success' => true, 'message' => 'Installation successful!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to write .env file. Check permissions.']);
}
