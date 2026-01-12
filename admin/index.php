<?php
session_start();
require_once '../config.php';
require_once 'auth_check.php';

// Fetch Statistics
// 1. Total Sales Count (Paid)
$stmt = $pdo->query("SELECT COUNT(DISTINCT invoice_id) FROM orders WHERE status = 'paid'");
$totalSales = $stmt->fetchColumn();

// 2. Total Revenue (Paid)
// Use DISTINCT invoice_id to avoid double counting if schema was different, but here total_amount is per row?
// Wait, if I split rows, each row has its own price (total_amount per item).
// So SUM(total_amount) WHERE status='paid' is correct for revenue.
$stmt = $pdo->query("SELECT SUM(total_amount) FROM orders WHERE status = 'paid'");
$totalRevenue = $stmt->fetchColumn();

// 3. Recent Orders
// Group by invoice_id to show one line per order
$stmt = $pdo->query("SELECT invoice_id, MAX(customer_name) as customer_name, SUM(total_amount) as total, MAX(status) as status, MAX(created_at) as created_at FROM orders GROUP BY invoice_id ORDER BY created_at DESC LIMIT 5");
$recentOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group mb-4">
                    <a href="index.php" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="products.php" class="list-group-item list-group-item-action">Produk</a>
                    <a href="vouchers.php" class="list-group-item list-group-item-action">Voucher</a>
                    <a href="banners.php" class="list-group-item list-group-item-action">Banner</a>
                    <a href="settings.php" class="list-group-item list-group-item-action">Pengaturan</a>
                </div>
            </div>
            <div class="col-md-9">
                <h3>Dashboard</h3>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Total Penjualan</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo number_format($totalSales); ?> Transaksi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Total Pendapatan</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp <?php echo number_format($totalRevenue); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <h4>Order Terbaru</h4>
                <table class="table table-striped">
                    <thead><tr><th>Invoice</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td><?php echo $order['invoice_id']; ?></td>
                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                            <td>Rp <?php echo number_format($order['total']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $order['status'] == 'paid' ? 'success' : 'warning'; ?>">
                                    <?php echo $order['status']; ?>
                                </span>
                            </td>
                            <td><?php echo $order['created_at']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
