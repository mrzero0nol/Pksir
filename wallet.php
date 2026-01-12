<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dompet Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="app-header glass-nav">
        <h4>Dompet</h4>
    </header>

    <div class="container py-4">
        <!-- Balance Card -->
        <div class="banner-card mb-4" style="height: 180px; flex-direction: column; align-items: flex-start; padding: 25px;">
            <span class="small opacity-75">Saldo Aktif</span>
            <h2 class="mt-2 mb-4">Rp 0</h2>
            <div class="d-flex gap-2 w-100">
                <button class="btn btn-light btn-sm rounded-pill flex-grow-1 text-primary fw-bold">
                    <i class="bi bi-plus-circle me-1"></i> Isi Saldo
                </button>
                <button class="btn btn-outline-light btn-sm rounded-pill flex-grow-1">
                    <i class="bi bi-clock-history me-1"></i> Riwayat
                </button>
            </div>
        </div>

        <div class="glass p-4 text-center">
            <div class="mb-3">
                <i class="bi bi-lock-fill" style="font-size: 2rem; color: var(--accent-color);"></i>
            </div>
            <h5>Fitur Member</h5>
            <p class="text-muted small">Silakan login atau daftar untuk menggunakan fitur Dompet dan menyimpan saldo.</p>
            <a href="profile.php" class="btn btn-primary rounded-pill w-100">Login / Daftar</a>
        </div>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
