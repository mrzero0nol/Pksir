<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';

$user = getCurrentUser($pdo);

// Check role from session directly for UI rendering (faster than DB query if session is fresh)
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Profil Saya - Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header -->
    <div class="header-container">
        <div class="brand-title">Profil</div>
        <div class="header-right">
            <i class="bi bi-gear fs-4 text-muted"></i>
        </div>
    </div>

    <div class="container pb-5" style="min-height: 100vh; background: #f4f6f8;">
        <?php if ($user): ?>
            <!-- LOGGED IN VIEW -->
            <div class="glass p-3 mb-3 mt-3" style="display: flex; align-items: center; gap: 15px;">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-3" style="width: 60px; height: 60px;">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold"><?= htmlspecialchars($user['name']) ?></h5>
                    <small class="text-muted">Username: <?= htmlspecialchars($user['username'] ?? '-') ?></small><br>
                    <small class="text-primary fw-bold">Saldo: Rp <?= number_format($user['balance'], 0, ',', '.') ?></small>
                </div>
            </div>

            <!-- Admin Menu Section -->
            <?php if ($isAdmin): ?>
            <div class="glass p-1 mb-3">
                <div class="p-2 px-3 border-bottom border-light text-muted small fw-bold">ADMINISTRATOR</div>
                <div class="list-group list-group-flush">
                    <a href="admin/index.php" class="list-group-item list-group-item-action border-0 py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-speedometer2 me-3 text-primary"></i>
                            <span class="fw-medium">Dashboard Admin</span>
                        </div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Menu User -->
            <div class="glass p-1 mb-3">
                <div class="list-group list-group-flush">
                    <a href="wallet.php" class="list-group-item list-group-item-action border-0 py-3 d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-wallet2 me-3 text-secondary"></i> Dompet Saya</div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                    <a href="history.php" class="list-group-item list-group-item-action border-0 py-3 d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-receipt me-3 text-secondary"></i> Riwayat Pesanan</div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3 d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-shield-lock me-3 text-secondary"></i> Ubah Password</div>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>

            <!-- Logout -->
            <div class="glass p-1 mb-4">
                 <a href="logout.php" class="list-group-item list-group-item-action border-0 py-3 text-danger text-center fw-bold">
                    Keluar Akun
                </a>
            </div>

        <?php else: ?>
            <!-- GUEST VIEW -->
            <div class="text-center py-5">
                <div class="d-inline-block rounded-circle bg-white shadow-sm mb-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-fill text-muted" style="font-size: 3rem;"></i>
                </div>
                <h4>Guest User</h4>
                <p class="text-muted">Silakan login untuk menikmati fitur lengkap</p>

                <div class="d-grid gap-2 col-10 mx-auto mt-4">
                    <a href="login.php" class="btn btn-primary rounded-pill py-2 fw-bold">Masuk Akun</a>
                    <a href="register.php" class="btn btn-outline-primary rounded-pill py-2 fw-bold">Daftar Baru</a>
                </div>
            </div>

            <div class="glass p-1 mb-4 mx-3">
                <div class="list-group list-group-flush">
                    <a href="history.php" class="list-group-item list-group-item-action border-0 py-3">
                        <i class="bi bi-receipt me-3"></i> Cek Pesanan (Guest)
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3">
                        <i class="bi bi-info-circle me-3"></i> Bantuan
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4 mb-5 pb-5">
            <small class="text-muted">Digital Premium v1.1.0</small>
        </div>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
