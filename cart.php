<?php
require_once 'config.php';
require_once 'includes/cart_helper.php';

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty'] ?? 1);
    addToCart($product_id, $qty);
    header("Location: cart.php");
    exit;
}

if ($action === 'update') {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty']);
    updateCartQty($product_id, $qty);
    header("Location: cart.php");
    exit;
}

if ($action === 'remove') {
    $product_id = intval($_POST['product_id']);
    removeFromCart($product_id);
    header("Location: cart.php");
    exit;
}

$cartItems = getCartItems($pdo);
$total = getCartTotal($pdo);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="app-header glass-nav" style="position: sticky; top: 0; z-index: 100;">
        <h4>Keranjang Belanja</h4>
        <?php if (!empty($cartItems)): ?>
            <form action="cart.php" method="POST" style="margin:0;">
                 <!-- Could add Clear Cart here -->
            </form>
        <?php endif; ?>
    </header>

    <div class="container pb-5">
        <?php if (empty($cartItems)): ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x" style="font-size: 3rem; color: var(--text-muted);"></i>
                <p class="mt-3 text-muted">Keranjang Anda kosong</p>
                <a href="index.php" class="btn btn-primary btn-sm rounded-pill px-4">Belanja Sekarang</a>
            </div>
        <?php else: ?>
            <div class="mt-3">
                <?php foreach ($cartItems as $item): ?>
                <div class="glass cart-item">
                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="cart-item-info">
                        <div class="fw-bold"><?= htmlspecialchars($item['name']) ?></div>
                        <div class="text-accent small">Rp <?= number_format($item['price'], 0, ',', '.') ?></div>

                        <div class="qty-control">
                            <form action="cart.php" method="POST" class="d-inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="qty" value="<?= $item['qty'] - 1 ?>">
                                <button type="submit" class="btn-qty"><i class="bi bi-dash"></i></button>
                            </form>

                            <span><?= $item['qty'] ?></span>

                            <form action="cart.php" method="POST" class="d-inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="qty" value="<?= $item['qty'] + 1 ?>">
                                <button type="submit" class="btn-qty"><i class="bi bi-plus"></i></button>
                            </form>

                            <form action="cart.php" method="POST" class="d-inline ms-auto">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn-qty bg-danger text-white border-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="glass p-3 mt-4 mb-5">
                <div class="d-flex justify-content-between mb-2">
                    <span>Total</span>
                    <span class="fw-bold fs-5 text-primary">Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
                <hr style="border-color: rgba(255,255,255,0.1);">

                <form action="checkout.php" method="POST">
                    <div class="mb-3">
                        <label class="small text-muted mb-1">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1">WhatsApp / Email</label>
                        <input type="text" name="contact" class="form-control" required placeholder="08123456789">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1">Kode Voucher (Opsional)</label>
                        <input type="text" name="voucher" class="form-control" placeholder="Masukan kode jika ada">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Bayar Sekarang</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/bottom_nav.php'; ?>

</body>
</html>
