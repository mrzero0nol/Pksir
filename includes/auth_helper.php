<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isUserLoggedIn()) {
        header("Location: login.php");
        exit;
    }
}

function getCurrentUser($pdo) {
    if (!isUserLoggedIn()) return null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
