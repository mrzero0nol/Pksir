<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="app-header glass-nav">
        <h4>Riwayat Transaksi</h4>
    </header>

    <div class="container py-4">
        <div class="glass p-4 mb-4">
            <h5>Cek Status Pesanan</h5>
            <p class="text-muted small">Masukan ID Invoice atau Nomor WhatsApp yang digunakan saat pembelian.</p>
            <form action="" method="GET">
                <div class="mb-3">
                    <input type="text" name="query" class="form-control" placeholder="INV-12345xxxxx atau 0812..." required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill">Cek Status</button>
            </form>
        </div>

        <?php
        if (isset($_GET['query'])) {
            $q = trim($_GET['query']);
            // Search by Invoice ID or Contact
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE invoice_id = ? OR customer_contact = ? ORDER BY id DESC LIMIT 5");
            $stmt->execute([$q, $q]);
            $orders = $stmt->fetchAll();

            if ($orders) {
                echo '<h6 class="mb-3">Hasil Pencarian:</h6>';
                foreach ($orders as $o) {
                    $statusColor = match($o['status']) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'secondary'
                    };

                    // Fetch product name
                    $pName = $pdo->query("SELECT name FROM products WHERE id = " . $o['product_id'])->fetchColumn();
                    ?>
                    <div class="glass p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="small text-muted"><?= $o['invoice_id'] ?></span>
                            <span class="badge bg-<?= $statusColor ?>"><?= ucfirst($o['status']) ?></span>
                        </div>
                        <div class="fw-bold my-2"><?= $pName ?> (x<?= $o['quantity'] ?? 1 ?>)</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary">Rp <?= number_format($o['total_amount'], 0, ',', '.') ?></span>
                            <a href="status.php?inv=<?= $o['invoice_id'] ?>" class="btn btn-sm btn-outline-light rounded-pill">Detail</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="alert alert-secondary">Pesanan tidak ditemukan.</div>';
            }
        }
        ?>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
