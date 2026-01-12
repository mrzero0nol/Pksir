<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';

if (isUserLoggedIn()) {
    header("Location: profile.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: profile.php");
            exit;
        } else {
            $error = "Email atau password salah.";
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
    <title>Login - DigitalShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container py-5">
        <div class="glass p-4" style="margin-top: 50px;">
            <h3 class="mb-3 text-center">Login Member</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="mb-1 text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="mb-1 text-muted">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Masuk</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">Belum punya akun? <a href="register.php" class="text-accent">Daftar disini</a></small>
            </div>
             <div class="text-center mt-2">
                <small><a href="index.php" class="text-muted">&laquo; Kembali ke Home</a></small>
            </div>
        </div>
    </div>
</body>
</html>
