<?php
require_once 'config.php';
require_once 'includes/cart_helper.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan");
}

$stock_count = $pdo->query("SELECT COUNT(*) FROM product_stocks WHERE product_id = $id AND status = 'available'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .product-hero {
            height: 300px;
            width: 100%;
            background: #2a2a2a;
            position: relative;
        }
        .product-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-detail-card {
            margin-top: -20px;
            border-radius: 20px 20px 0 0;
            padding: 25px 20px;
            background: var(--bg-color);
            position: relative;
            z-index: 10;
            min-height: 50vh;
        }
    </style>
</head>
<body>

    <div class="product-hero">
        <a href="index.php" class="btn-icon" style="position: absolute; top: 20px; left: 20px; z-index: 20; background: rgba(0,0,0,0.5); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>

    <div class="product-detail-card">
        <h2 class="h4 mb-1"><?= htmlspecialchars($product['name']) ?></h2>
        <h3 class="text-primary mb-3">Rp <?= number_format($product['price'], 0, ',', '.') ?></h3>

        <?php if ($stock_count > 0): ?>
            <span class="badge bg-success mb-3">Stok Tersedia: <?= $stock_count ?></span>
        <?php else: ?>
            <span class="badge bg-danger mb-3">Stok Habis</span>
        <?php endif; ?>

        <p class="text-muted small mb-4">
            <?= nl2br(htmlspecialchars($product['description'])) ?>
        </p>

        <div style="height: 80px;"></div> <!-- Spacer -->
    </div>

    <!-- Fixed Bottom Action Bar -->
    <div class="glass-nav p-3 fixed-bottom d-flex gap-2">
        <?php if ($stock_count > 0): ?>
            <form action="cart.php" method="POST" class="w-50">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button class="btn btn-outline-light w-100 rounded-pill">
                    <i class="bi bi-cart-plus"></i> Cart
                </button>
            </form>
            <form action="cart.php" method="POST" class="w-50">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button class="btn btn-primary w-100 rounded-pill">
                    Beli Sekarang
                </button>
            </form>
        <?php else: ?>
            <button class="btn btn-secondary w-100 rounded-pill" disabled>Stok Habis</button>
        <?php endif; ?>
    </div>

</body>
</html>
