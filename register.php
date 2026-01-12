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
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($username) && !empty($password)) {
        // Check if username or email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = "Username atau Email sudah terdaftar.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // Default role is 'user'
            $stmt = $pdo->prepare("INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, 'user')");
            if ($stmt->execute([$username, $name, $email, $hash])) {
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
    <title>Daftar - Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="auth-card p-4 mx-auto" style="max-width: 400px; margin-top: 50px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Daftar Akun</h3>
                <p class="text-muted small">Buat akun untuk mulai berbelanja</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email (Opsional)</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-primary fw-bold">Masuk disini</a></small>
            </div>
        </div>
    </div>
</body>
</html>
