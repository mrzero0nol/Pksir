<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';

if (isUserLoggedIn()) {
    header("Location: profile.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email sudah terdaftar.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$name, $email, $hash])) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $error = "Gagal mendaftar. Coba lagi.";
            }
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar - DigitalShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="glass p-4" style="margin-top: 50px;">
            <h3 class="mb-3 text-center">Daftar Akun</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="mb-1 text-muted">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="mb-1 text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 text-muted">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-accent">Masuk disini</a></small>
            </div>
        </div>
    </div>
</body>
</html>
