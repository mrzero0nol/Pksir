<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';
require_once 'includes/pakasir_api.php';

requireLogin();

$user = getCurrentUser($pdo);

// Handle Top Up
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount = intval($_POST['amount']);
    if ($amount < 1000) {
        $error = "Minimal top up Rp 1.000";
    } else {
        $invoice_id = 'TOP-' . time() . rand(100, 999);
        $redirect_url = APP_URL . "/wallet.php"; // Redirect back to wallet after payment

        // Use Payment Gateway (QRIS)
        // Note: We need to handle the webhook to actually add balance.
        $pay_url = "https://app.pakasir.com/pay/" . PAKASIR_PROJECT_SLUG . "/" . $amount . "?order_id=" . $invoice_id . "&redirect=" . urlencode($redirect_url) . "&qris_only=1";

        // Record Transaction as Pending
        $stmt = $pdo->prepare("INSERT INTO wallet_transactions (user_id, type, amount, description, status, invoice_id, payment_url) VALUES (?, 'deposit', ?, 'Top Up Saldo', 'pending', ?, ?)");
        $stmt->execute([$user['id'], $amount, $invoice_id, $pay_url]);

        header("Location: " . $pay_url);
        exit;
    }
}

// Fetch Transactions
$stmt = $pdo->prepare("SELECT * FROM wallet_transactions WHERE user_id = ? ORDER BY id DESC LIMIT 10");
$stmt->execute([$user['id']]);
$transactions = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
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
        <div class="banner-card mb-4" style="height: auto; flex-direction: column; align-items: flex-start; padding: 25px;">
            <span class="small opacity-75">Saldo Aktif</span>
            <h2 class="mt-2 mb-4">Rp <?= number_format($user['balance'], 0, ',', '.') ?></h2>

            <form method="POST" class="w-100">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent text-white border-light">Rp</span>
                    <input type="number" name="amount" class="form-control bg-transparent text-white border-light" placeholder="Minimal 1000" min="1000" required>
                </div>
                <button type="submit" class="btn btn-light w-100 rounded-pill text-primary fw-bold">
                    <i class="bi bi-plus-circle me-1"></i> Top Up Sekarang
                </button>
            </form>
        </div>

        <h5 class="mb-3">Riwayat Transaksi</h5>
        <div class="glass p-1">
            <?php if (empty($transactions)): ?>
                <div class="p-4 text-center text-muted">Belum ada transaksi.</div>
            <?php else: ?>
                <?php foreach ($transactions as $t): ?>
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-secondary">
                    <div>
                        <div class="fw-bold"><?= htmlspecialchars($t['description']) ?></div>
                        <small class="text-muted"><?= $t['created_at'] ?></small>

                        <?php if ($t['status'] == 'pending' && $t['type'] == 'deposit'): ?>
                            <br><a href="<?= $t['payment_url'] ?>" class="badge bg-warning text-dark text-decoration-none">Bayar Sekarang</a>
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <?php if ($t['type'] == 'deposit'): ?>
                            <div class="text-success fw-bold">+ Rp <?= number_format($t['amount'], 0, ',', '.') ?></div>
                        <?php else: ?>
                            <div class="text-danger fw-bold">- Rp <?= number_format($t['amount'], 0, ',', '.') ?></div>
                        <?php endif; ?>

                        <?php
                        $badge = match($t['status']) {
                            'success' => 'success',
                            'pending' => 'warning',
                            'failed' => 'danger',
                            default => 'secondary'
                        };
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= ucfirst($t['status']) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
