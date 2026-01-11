<?php
require_once 'config.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">&laquo; Kembali ke Toko</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-5">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="col-md-7">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <h3 class="text-primary my-3">Rp <?= number_format($product['price'], 0, ',', '.') ?></h3>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>

                <hr>

                <?php if ($stock_count > 0): ?>
                    <div class="alert alert-success">Stok Tersedia: <?= $stock_count ?></div>

                    <div class="card bg-light">
                        <div class="card-body">
                            <h5>Form Pemesanan</h5>
                            <form action="checkout.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <div class="mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Nomor WhatsApp / Email (untuk info pesanan)</label>
                                    <input type="text" name="contact" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Kode Voucher (Opsional)</label>
                                    <input type="text" name="voucher" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success btn-lg w-100">Lanjut Pembayaran</button>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="alert alert-danger">Maaf, stok saat ini sedang habis.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
