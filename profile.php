<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';

$user = getCurrentUser($pdo);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container py-5">
        <?php if ($user): ?>
            <!-- LOGGED IN VIEW -->
            <div class="text-center mb-5">
                <div class="d-inline-block rounded-circle bg-primary mb-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <span class="text-white fs-1 fw-bold"><?= strtoupper(substr($user['name'], 0, 1)) ?></span>
                </div>
                <h4><?= htmlspecialchars($user['name']) ?></h4>
                <p class="text-accent mb-0">Saldo: Rp <?= number_format($user['balance'], 0, ',', '.') ?></p>
                <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
            </div>

            <div class="glass p-1 mb-4">
                <div class="list-group list-group-flush bg-transparent">
                    <a href="wallet.php" class="list-group-item bg-transparent text-white border-bottom border-secondary py-3">
                        <i class="bi bi-wallet2 me-3"></i> Dompet Saya
                    </a>
                    <a href="history.php" class="list-group-item bg-transparent text-white border-bottom border-secondary py-3">
                        <i class="bi bi-receipt me-3"></i> Riwayat Pesanan
                    </a>
                    <a href="#" class="list-group-item bg-transparent text-white border-bottom border-secondary py-3">
                        <i class="bi bi-gear me-3"></i> Pengaturan Akun
                    </a>
                     <a href="logout.php" class="list-group-item bg-transparent text-danger py-3">
                        <i class="bi bi-box-arrow-right me-3"></i> Keluar
                    </a>
                </div>
            </div>

        <?php else: ?>
            <!-- GUEST VIEW -->
            <div class="text-center mb-5">
                <div class="d-inline-block rounded-circle bg-secondary mb-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <i class="bi bi-person-fill" style="font-size: 3rem; color: #ddd;"></i>
                </div>
                <h4>Guest User</h4>
                <p class="text-muted">Belum Login</p>
            </div>

            <div class="glass p-1 mb-4">
                <div class="list-group list-group-flush bg-transparent">
                    <a href="history.php" class="list-group-item bg-transparent text-white border-bottom border-secondary py-3">
                        <i class="bi bi-receipt me-3"></i> Riwayat Pesanan
                    </a>
                    <a href="#" class="list-group-item bg-transparent text-white border-bottom border-secondary py-3">
                        <i class="bi bi-shield-lock me-3"></i> Kebijakan Privasi
                    </a>
                    <a href="#" class="list-group-item bg-transparent text-white py-3">
                        <i class="bi bi-question-circle me-3"></i> Bantuan & Support
                    </a>
                </div>
            </div>

            <div class="d-grid gap-2">
                <a href="login.php" class="btn btn-primary rounded-pill py-2">Masuk Akun</a>
                <a href="register.php" class="btn btn-outline-light rounded-pill py-2">Daftar Baru</a>
            </div>
        <?php endif; ?>

        <div class="text-center mt-5 mb-5 pb-5">
            <small class="text-muted">Versi Aplikasi 1.0.1</small><br>
            <a href="admin/login.php" class="text-muted small" style="opacity: 0.3; text-decoration: none;">Admin Login</a>
        </div>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
