<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in AND is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not logged in, redirect to main login
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.php');
    } else {
        // If logged in but not admin, redirect to home
        header('Location: ../index.php');
    }
    exit;
}
?>
