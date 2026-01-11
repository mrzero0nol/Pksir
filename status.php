<?php
require_once 'config.php';

$invoice_id = $_GET['inv'] ?? '';
if (!$invoice_id) header('Location: index.php');

$stmt = $pdo->prepare("SELECT o.*, p.name as product_name, p.description
                       FROM orders o
                       JOIN products p ON o.product_id = p.id
                       WHERE o.invoice_id = ?");
$stmt->execute([$invoice_id]);
$order = $stmt->fetch();

if (!$order) die("Pesanan tidak ditemukan.");

// Retrieve Purchased Item if Paid
$account_data = null;
if ($order['status'] == 'paid') {
    $stockStmt = $pdo->prepare("SELECT account_data FROM product_stocks WHERE order_id = ?");
    $stockStmt->execute([$order['id']]);
    $stock = $stockStmt->fetch();
    if ($stock) {
        $account_data = $stock['account_data'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan - <?= htmlspecialchars($invoice_id) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="30"> <!-- Auto refresh every 30s -->
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white text-center">
                <h4>Status Pesanan</h4>
            </div>
            <div class="card-body text-center">
                <h5>Invoice: <?= htmlspecialchars($invoice_id) ?></h5>
                <p class="text-muted"><?= htmlspecialchars($order['product_name']) ?></p>

                <?php if ($order['status'] == 'paid'): ?>
                    <div class="alert alert-success">
                        <h4>Pembayaran Berhasil!</h4>
                        <p>Terima kasih telah berbelanja.</p>
                    </div>

                    <div class="card bg-light mt-3">
                        <div class="card-body text-start">
                            <h5>Data Produk Anda:</h5>
                            <pre class="bg-white p-3 border rounded"><?= htmlspecialchars($account_data ?: 'Hubungi Admin (Stok Gagal Diambil)') ?></pre>
                            <p class="small text-danger">Simpan data ini sekarang. Jangan berikan kepada orang lain.</p>
                        </div>
                    </div>

                <?php elseif ($order['status'] == 'pending'): ?>
                    <div class="alert alert-warning">
                        <h4>Menunggu Pembayaran</h4>
                        <p>Silakan selesaikan pembayaran Anda.</p>
                        <p>Halaman ini akan otomatis refresh setiap 30 detik.</p>
                    </div>
                    <a href="<?= htmlspecialchars($order['payment_url']) ?>" class="btn btn-primary">Buka Halaman Pembayaran</a>

                <?php else: ?>
                    <div class="alert alert-danger">
                        <h4>Status: <?= ucfirst($order['status']) ?></h4>
                    </div>
                <?php endif; ?>

                <hr>
                <a href="index.php" class="btn btn-outline-secondary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
