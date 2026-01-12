<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';

if (isUserLoggedIn()) {
    header("Location: profile.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Authenticate via username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'] ?? 'user'; // Store role

            header("Location: profile.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="auth-card p-4 mx-auto" style="max-width: 400px; margin-top: 50px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Login</h3>
                <p class="text-muted small">Masuk untuk melanjutkan</p>
            </div>

            <?php if (isset($_GET['registered'])): ?>
                <div class="alert alert-success">Pendaftaran berhasil. Silakan login.</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Masuk</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">Belum punya akun? <a href="register.php" class="text-primary fw-bold">Daftar disini</a></small>
            </div>
             <div class="text-center mt-2">
                <small><a href="index.php" class="text-muted text-decoration-none">&laquo; Kembali ke Home</a></small>
            </div>
        </div>
    </div>
</body>
</html>
