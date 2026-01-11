<?php
require_once '../config.php';
require_once 'auth_check.php';

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    header('Location: products.php');
    exit;
}

$product = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$product->execute([$product_id]);
$product = $product->fetch();

if (!$product) {
    die("Produk tidak ditemukan");
}

// Add Stock
if (isset($_POST['add_stock'])) {
    $data = $_POST['account_data'];
    // Split by new line for bulk add
    $lines = explode("\n", $data);

    $stmt = $pdo->prepare("INSERT INTO product_stocks (product_id, account_data, status) VALUES (?, ?, 'available')");

    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line)) {
            $stmt->execute([$product_id, $line]);
        }
    }

    header("Location: stock_manage.php?id=$product_id");
    exit;
}

// Delete Stock
if (isset($_GET['delete_stock'])) {
    $stock_id = $_GET['delete_stock'];
    $stmt = $pdo->prepare("DELETE FROM product_stocks WHERE id = ? AND status = 'available'");
    $stmt->execute([$stock_id]);
    header("Location: stock_manage.php?id=$product_id");
    exit;
}

// Fetch Stocks
$stocks = $pdo->prepare("SELECT * FROM product_stocks WHERE product_id = ? ORDER BY id DESC");
$stocks->execute([$product_id]);
$stocks = $stocks->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Stok - <?= htmlspecialchars($product['name']) ?></title>
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
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" class="text-danger">Logout</a>
        </div>
        <div class="content flex-grow-1">
            <a href="products.php" class="btn btn-secondary mb-3">&laquo; Kembali</a>
            <h2>Atur Stok: <?= htmlspecialchars($product['name']) ?></h2>

            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Tambah Stok</h5>
                        <p class="small text-muted">Masukkan data akun (Email/Password). Satu baris per akun.</p>
                        <form method="POST">
                            <div class="mb-3">
                                <textarea name="account_data" class="form-control" rows="10" placeholder="email:password&#10;user2:pass2" required></textarea>
                            </div>
                            <button type="submit" name="add_stock" class="btn btn-success w-100">Simpan Stok</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card p-3">
                        <h5>Daftar Stok</h5>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data Akun</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocks as $s): ?>
                                <tr>
                                    <td><?= $s['id'] ?></td>
                                    <td>
                                        <code><?= htmlspecialchars($s['account_data']) ?></code>
                                        <?php if ($s['order_id']): ?>
                                            <br><small class="text-muted">Order ID: <?= $s['order_id'] ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $s['status'] == 'available' ? 'success' : 'secondary' ?>">
                                            <?= ucfirst($s['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($s['status'] == 'available'): ?>
                                            <a href="?id=<?= $product_id ?>&delete_stock=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
