<?php
require_once 'config.php';

$keyword = $_GET['keyword'] ?? '';
$orders = [];

if ($keyword) {
    // Search by Invoice OR Contact
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE invoice_id = ? OR customer_contact = ? ORDER BY created_at DESC LIMIT 20");
    $stmt->execute([$keyword, $keyword]);
    $orders = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pesanan - Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h4 class="fw-bold mb-4">Riwayat Pesanan</h4>

                    <form action="" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Masukkan Invoice ID atau No. HP..." value="<?= htmlspecialchars($keyword) ?>">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>

                    <?php if ($keyword && count($orders) > 0): ?>
                        <div class="list-group">
                            <?php foreach ($orders as $o): ?>
                                <?php
                                    $statusClass = match($o['status']) {
                                        'paid' => 'success',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        default => 'secondary'
                                    };
                                    $statusLabel = match($o['status']) {
                                        'paid' => 'BERHASIL',
                                        'pending' => 'MENUNGGU',
                                        'failed' => 'GAGAL',
                                        default => strtoupper($o['status'])
                                    };
                                ?>
                                <div class="list-group-item list-group-item-action p-3 mb-2 border rounded">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 fw-bold"><?= $o['invoice_id'] ?></h6>
                                            <small class="text-muted"><?= $o['created_at'] ?></small>
                                        </div>
                                        <span class="badge bg-<?= $statusClass ?>"><?= $statusLabel ?></span>
                                    </div>
                                    <p class="mb-1 mt-2">Total: Rp <?= number_format($o['total_amount'], 0, ',', '.') ?></p>

                                    <div class="mt-3">
                                        <?php if ($o['status'] == 'pending'): ?>
                                            <a href="<?= htmlspecialchars($o['payment_url']) ?>" class="btn btn-sm btn-warning w-100">Bayar Sekarang</a>
                                        <?php elseif ($o['status'] == 'paid'): ?>
                                            <!-- Logic to show voucher/account data if available -->
                                            <?php
                                                // Fetch the stock data assigned to this order
                                                $stockStmt = $pdo->prepare("SELECT account_data FROM product_stocks WHERE order_id = ?");
                                                $stockStmt->execute([$o['id']]);
                                                $stockItem = $stockStmt->fetch();
                                            ?>
                                            <?php if ($stockItem): ?>
                                                <div class="alert alert-success mb-0 mt-2">
                                                    <strong>Data Produk:</strong><br>
                                                    <code class="user-select-all"><?= htmlspecialchars($stockItem['account_data']) ?></code>
                                                </div>
                                            <?php else: ?>
                                                <div class="alert alert-info mb-0 mt-2">Sedang diproses admin...</div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($keyword): ?>
                        <div class="text-center py-5">
                            <i class="fa-solid fa-search fa-2x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ditemukan pesanan dengan kata kunci tersebut.</p>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">Silakan masukkan Nomor Invoice atau Nomor HP untuk melihat riwayat.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
