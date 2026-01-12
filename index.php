<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';
require_once 'includes/cart_helper.php';

// Fetch Banners
$stmt = $pdo->query("SELECT * FROM banners WHERE is_active = 1 ORDER BY sort_order ASC");
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Settings for Title
$stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = 'site_title'");
$stmt->execute();
$settings = ['site_title' => $stmt->fetchColumn() ?: 'Toko Digital'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings['site_title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <!-- Banner Carousel -->
    <?php if (!empty($banners)): ?>
    <div id="bannerCarousel" class="carousel slide banner-container" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($banners as $index => $banner): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <a href="<?php echo $banner['link_url'] ?: '#'; ?>">
                        <img src="<?php echo $banner['image_url']; ?>" class="d-block w-100" alt="Banner">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Product Grid -->
    <h5 class="mb-3">Produk Terbaru</h5>
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
        <?php foreach ($products as $product): ?>
        <div class="col">
            <div class="card product-card h-100">
                <img src="<?php echo $product['image_url'] ?: 'https://via.placeholder.com/300'; ?>" class="card-img-top product-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="card-body product-body d-flex flex-column">
                    <h5 class="card-title product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="card-text product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm mt-auto w-100">Beli</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/bottom_nav.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
