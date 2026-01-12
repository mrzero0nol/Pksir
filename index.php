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
    <title>Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header -->
    <div class="header-container">
        <div class="brand-title">Digital Premium</div>
        <div class="header-right">
             <div class="search-bar-wrapper" style="width: 150px;">
                <input type="text" class="search-input-header" placeholder="Cari...">
                <i class="bi bi-search search-icon-header"></i>
            </div>
            <i class="bi bi-list fs-4 text-muted"></i>
        </div>
    </div>

    <!-- Main Content Wrapper -->
    <div style="background: #f4f6f8; min-height: 100vh;">

        <!-- Banner -->
        <div class="banner-container">
            <div class="banner-content">
                <div style="z-index: 1;">
                    <div class="banner-title">JASA TITIP JUAL BELI AKUN GAME TERPERCAYA</div>
                    <div class="banner-subtitle">Genshin Impact, Mobile Legends, Free Fire, Valorant, dan Lain-lain</div>
                    <div class="banner-actions">
                        <button class="btn-banner">Jual Sekarang</button>
                        <button class="btn-banner">Beli Sekarang</button>
                    </div>
                </div>
                <!-- Placeholder Image for Banner - In real scenario, use actual asset -->
                <!-- <img src="assets/img/banner-char.png" class="banner-img" alt="Characters"> -->
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
        <div class="product-grid">
            <?php foreach ($products as $p): ?>
            <div class="product-card">
                <a href="product.php?id=<?= $p['id'] ?>" class="product-img-wrapper">
                    <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                    <?php if ($p['stock_count'] > 0): ?>
                        <?php if($p['stock_count'] <= 3): ?>
                            <span class="badge-stock">SISA <?= $p['stock_count'] ?></span>
                        <?php else: ?>
                            <span class="badge-stock badge-ready">READY</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="badge-stock" style="background: #ccc;">HABIS</span>
                    <?php endif; ?>
                </a>
                <div class="product-info">
                    <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                    <div class="product-price">Rp <?= number_format($p['price'], 0, ',', '.') ?></div>
                    <div style="font-size: 0.7rem; color: #999; margin-top: 5px;">
                        <?= $p['stock_count'] > 0 ? 'Instant Delivery' : 'Out of Stock' ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Spacer for Bottom Nav -->
        <div style="height: 80px;"></div>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
