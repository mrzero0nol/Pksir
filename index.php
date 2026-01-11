<?php
require_once 'config.php';

// Fetch Categories
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Fetch Products (with stock count)
$query = "SELECT p.*, c.name as category_name,
         (SELECT COUNT(*) FROM product_stocks s WHERE s.product_id = p.id AND s.status = 'available') as stock_count
         FROM products p JOIN categories c ON p.category_id = c.id";

if (isset($_GET['cat'])) {
    $query .= " WHERE p.category_id = " . intval($_GET['cat']);
}
$query .= " ORDER BY p.id DESC";
$products = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Produk Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero { background: #007bff; color: white; padding: 50px 0; text-align: center; }
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">DigitalShop</a>
            <div class="ms-auto">
                <a href="admin/login.php" class="btn btn-outline-light btn-sm">Admin Login</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Selamat Datang di DigitalShop</h1>
            <p>Beli Akun Premium, Voucher Game, dan Produk Digital Lainnya.</p>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.php" class="list-group-item list-group-item-action <?= !isset($_GET['cat']) ? 'active' : '' ?>">Semua Kategori</a>
                    <?php foreach ($categories as $cat): ?>
                    <a href="?cat=<?= $cat['id'] ?>" class="list-group-item list-group-item-action <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($products as $p): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="<?= htmlspecialchars($p['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
                                <p class="card-text text-muted small"><?= htmlspecialchars($p['category_name']) ?></p>
                                <h6 class="text-primary">Rp <?= number_format($p['price'], 0, ',', '.') ?></h6>

                                <?php if ($p['stock_count'] > 0): ?>
                                    <span class="badge bg-success mb-2">Stok: <?= $p['stock_count'] ?></span>
                                    <a href="product.php?id=<?= $p['id'] ?>" class="btn btn-primary w-100">Beli Sekarang</a>
                                <?php else: ?>
                                    <span class="badge bg-secondary mb-2">Stok Habis</span>
                                    <button class="btn btn-secondary w-100" disabled>Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p>&copy; <?= date('Y') ?> DigitalShop. All rights reserved.</p>
    </footer>
</body>
</html>
