<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli <?= htmlspecialchars($product['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid rounded-3 shadow-sm w-100" alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-primary mb-2"><?= htmlspecialchars($product['category_name']) ?></span>
                            <h2 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h2>
                            <h3 class="text-primary fw-bold my-3">Rp <?= number_format($product['price'], 0, ',', '.') ?></h3>

                            <div class="p-3 bg-light rounded mb-4 border">
                                <h6 class="fw-bold"><i class="fa-solid fa-circle-info me-2"></i>Deskripsi Produk</h6>
                                <p class="mb-0 text-muted small"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                            </div>

                            <hr>

                            <?php if ($stock_count > 0): ?>
                                <div class="alert alert-success d-flex align-items-center">
                                    <i class="fa-solid fa-check-circle me-2"></i>
                                    <div>Stok Tersedia: <strong><?= $stock_count ?></strong></div>
                                </div>

                                <h5 class="fw-bold mb-3">Lengkapi Data Pesanan</h5>
                                <form action="checkout.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nomor WhatsApp / Email</label>
                                            <input type="text" name="contact" class="form-control" required placeholder="08123456789">
                                            <div class="form-text">Pesanan akan dilacak menggunakan nomor ini.</div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Kode Voucher (Opsional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-ticket"></i></span>
                                            <input type="text" name="voucher" class="form-control" placeholder="Masukan kode promo jika ada">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm">
                                        <i class="fa-solid fa-lock me-2"></i>Bayar Sekarang
                                    </button>
                                </form>

                            <?php else: ?>
                                <div class="alert alert-danger py-4 text-center">
                                    <i class="fa-solid fa-times-circle fa-2x mb-2"></i>
                                    <h5>Stok Habis</h5>
                                    <p class="mb-0">Maaf, produk ini sedang tidak tersedia. Silakan cek lagi nanti.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
