<?php
// user/index.php
require_once '../config.php';
require_once '../includes/auth_helper.php';

requireLogin();
$user = getCurrentUser($pdo);

// Fetch orders
// Assuming 'customer_contact' stores email for now, or we need to link orders to user_id.
// For now, let's just show profile.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/header.php'; ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h3>Halo, <?php echo htmlspecialchars($user['name']); ?></h3>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>HP: <?php echo htmlspecialchars($user['phone']); ?></p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
<?php include '../includes/bottom_nav.php'; ?>
</body>
</html>
