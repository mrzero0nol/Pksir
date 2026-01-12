<?php
require_once '../config.php';
require_once 'auth_check.php';

// Get Stats
$stats = [
    'sales' => $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'paid'")->fetchColumn(),
    'revenue' => $pdo->query("SELECT SUM(total_amount) FROM orders WHERE status = 'paid'")->fetchColumn() ?: 0,
    'products' => $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn(),
    'pending' => $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn()
];

// Recent Orders
$orders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 10")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4>Admin Panel</h4>
            <a href="index.php">Dashboard</a>
            <a href="products.php">Produk & Kategori</a>
            <a href="vouchers.php">Voucher</a>
            <a href="settings.php">Pengaturan</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" class="text-danger">Logout</a>
        </div>
        <div class="content flex-grow-1">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-white p-3">
                        <h5>Total Penjualan</h5>
                        <h3><?= $stats['sales'] ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white p-3">
                        <h5>Total Pendapatan</h5>
                        <h3>Rp <?= number_format($stats['revenue'], 0, ',', '.') ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white p-3">
                        <h5>Total Produk</h5>
                        <h3><?= $stats['products'] ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark p-3">
                        <h5>Menunggu Pembayaran</h5>
                        <h3><?= $stats['pending'] ?></h3>
                    </div>
                </div>
            </div>

            <h4 class="mt-4">Transaksi Terakhir</h4>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['invoice_id'] ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge bg-<?= $order['status'] == 'paid' ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'danger') ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td><?= $order['created_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
