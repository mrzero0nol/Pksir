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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Digital Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <!-- Banner Carousel -->
    <div class="banner-container">
        <div class="banner-card">
            <span>PROMO SPESIAL 50%</span>
        </div>
    </div>

    <!-- Categories -->
    <div class="category-scroll">
        <a href="index.php" class="cat-pill <?= !isset($_GET['cat']) ? 'active' : '' ?>">Semua</a>
        <?php foreach ($categories as $cat): ?>
        <a href="?cat=<?= $cat['id'] ?>" class="cat-pill <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'active' : '' ?>">
            <?= htmlspecialchars($cat['name']) ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Products -->
    <h3 class="section-title">Produk Terbaru</h3>
    <div class="product-grid">
        <?php foreach ($products as $p): ?>
        <div class="glass product-card">
            <a href="product.php?id=<?= $p['id'] ?>" class="product-img-wrapper">
                <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                <?php if ($p['stock_count'] > 0): ?>
                    <span class="badge-stock">Stok: <?= $p['stock_count'] ?></span>
                <?php else: ?>
                    <span class="badge-stock" style="background: red;">Habis</span>
                <?php endif; ?>
            </a>
            <div class="product-info">
                <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                <div class="product-price">Rp <?= number_format($p['price'], 0, ',', '.') ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
