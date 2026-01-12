<?php
require_once 'config.php';
require_once 'includes/auth_helper.php';
require_once 'includes/cart_helper.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produk tidak ditemukan");
}

if (isset($_POST['add_to_cart'])) {
    addToCart($id, 1);
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image_url'] ?: 'https://via.placeholder.com/500'; ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <h3 class="text-primary">Rp <?php echo number_format($product['price']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <form method="POST">
                <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg w-100">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/bottom_nav.php'; ?>
</body>
</html>
