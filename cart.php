<?php
session_start();
require_once 'config.php';
require_once 'includes/auth_helper.php';
require_once 'includes/cart_helper.php';

// Empty cart
// Add logic to process cart to order...
// Since this is a task focusing on UI and Install, I'll make a simple Cart UI.

if (isset($_GET['remove'])) {
    removeFromCart($_GET['remove']);
    header('Location: cart.php');
    exit;
}

$cartItems = getCartItems($pdo);
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container mt-4">
    <h3>Keranjang Belanja</h3>
    <?php if (empty($cartItems)): ?>
        <p>Keranjang kosong. <a href="index.php">Belanja sekarang</a></p>
    <?php else: ?>
        <table class="table">
            <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>Rp <?php echo number_format($item['price']); ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>Rp <?php echo number_format($item['price'] * $item['qty']); ?></td>
                    <td><a href="?remove=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>Rp <?php echo number_format($total); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-success w-100">Checkout</a>
    <?php endif; ?>
</div>
<?php include 'includes/bottom_nav.php'; ?>
</body>
</html>
