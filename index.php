<?php
require_once 'config.php';

// Fetch Categories
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Fetch Products (with stock count)
$query = "SELECT p.*, c.name as category_name,
         (SELECT COUNT(*) FROM product_stocks s WHERE s.product_id = p.id AND s.status = 'available') as stock_count
         FROM products p JOIN categories c ON p.category_id = c.id";

if (isset($_GET['cat'])) {
    $catId = intval($_GET['cat']);
    $query .= " WHERE p.category_id = " . $catId;
}
$query .= " ORDER BY p.id DESC";
$products = $pdo->query($query)->fetchAll();

// Stats for Hero
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_sales = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'paid'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Premium Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-store me-2"></i>DigitalPremium
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item me-2">
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#trackModal">
                            <i class="fa-solid fa-search me-1"></i> Cek Pesanan
                        </button>
                    </li>
                    <!-- Admin Hidden Trigger -->
                    <li class="nav-item">
                        <a href="admin/login.php" class="nav-link text-muted small"><i class="fa-solid fa-user-shield"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Top Up Game & Produk Digital</h1>
            <p class="lead mb-4 opacity-75">Solusi terbaik untuk kebutuhan digital Anda. Cepat, Aman, dan Terpercaya.</p>
            <div class="d-flex justify-content-center gap-4 text-white">
                <div>
                    <h4 class="fw-bold mb-0"><?= $total_products ?>+</h4>
                    <small>Produk</small>
                </div>
                <div>
                    <h4 class="fw-bold mb-0"><?= $total_sales ?>+</h4>
                    <small>Terjual</small>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Category Filter -->
        <div class="category-tabs mb-4">
            <a href="index.php" class="cat-tab <?= !isset($_GET['cat']) ? 'active' : '' ?>">
                <i class="fa-solid fa-border-all me-1"></i> Semua
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="?cat=<?= $cat['id'] ?>" class="cat-tab <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'active' : '' ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Product Grid -->
        <div class="row">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $p): ?>
                <div class="col-6 col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="product-img-container">
                            <img src="<?= htmlspecialchars($p['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
                            <?php if ($p['stock_count'] > 0): ?>
                                <span class="stock-badge bg-success text-white">Ready</span>
                            <?php else: ?>
                                <span class="stock-badge bg-secondary text-white">Habis</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1"><?= htmlspecialchars($p['category_name']) ?></small>
                            <h6 class="card-title fw-bold text-dark mb-auto"><?= htmlspecialchars($p['name']) ?></h6>
                            <div class="mt-3">
                                <p class="text-primary fw-bold mb-2">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                                <?php if ($p['stock_count'] > 0): ?>
                                    <a href="product.php?id=<?= $p['id'] ?>" class="btn btn-primary w-100 btn-sm">Beli</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100 btn-sm" disabled>Stok Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                    <p>Belum ada produk di kategori ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-white py-4 mt-auto border-top">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; <?= date('Y') ?> Digital Premium. All rights reserved.</p>
        </div>
    </footer>

    <!-- Track Order Modal -->
    <div class="modal fade" id="trackModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-search me-2"></i>Cek Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="track.php" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Nomor Invoice atau No. HP</label>
                            <input type="text" name="keyword" class="form-control" placeholder="INV-xxx atau 0812xxx" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cari Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
