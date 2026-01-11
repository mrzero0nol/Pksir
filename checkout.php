<?php
require_once 'config.php';
require_once 'includes/pakasir_api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$product_id = $_POST['product_id'];
$customer_name = $_POST['name'];
$customer_contact = $_POST['contact'];
$voucher_code = trim($_POST['voucher'] ?? '');

// 1. Fetch Product
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) die("Produk tidak valid.");

// 2. Check Stock again
$stock_count = $pdo->query("SELECT COUNT(*) FROM product_stocks WHERE product_id = $product_id AND status = 'available'")->fetchColumn();
if ($stock_count <= 0) die("Stok habis.");

// 3. Calculate Price & Apply Voucher
$price = $product['price'];
$discount = 0;

if ($voucher_code) {
    $vStmt = $pdo->prepare("SELECT * FROM vouchers WHERE code = ? AND status = 'active' AND (usage_limit = 0 OR used_count < usage_limit)");
    $vStmt->execute([$voucher_code]);
    $voucher = $vStmt->fetch();

    if ($voucher) {
        if ($voucher['discount_type'] == 'fixed') {
            $discount = $voucher['discount_value'];
        } else {
            $discount = ($price * $voucher['discount_value']) / 100;
        }
    } else {
        $voucher_code = null;
    }
} else {
    $voucher_code = null;
}

$total_amount = $price - $discount;
if ($total_amount < 1000) $total_amount = 1000; // Minimum for most Qris

// 4. Create Order in DB
$invoice_id = 'INV-' . time() . rand(100, 999);
$stmt = $pdo->prepare("INSERT INTO orders (invoice_id, product_id, customer_name, customer_contact, total_amount, voucher_code, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
$stmt->execute([$invoice_id, $product_id, $customer_name, $customer_contact, $total_amount, $voucher_code]);
$order_db_id = $pdo->lastInsertId();

// 5. Generate Payment URL (Integrasi Via URL)
$redirect_url = APP_URL . "/status.php?inv=" . $invoice_id;
$pay_url = "https://app.pakasir.com/pay/" . PAKASIR_PROJECT_SLUG . "/" . (int)$total_amount . "?order_id=" . $invoice_id . "&redirect=" . urlencode($redirect_url) . "&qris_only=1";

// Update DB with this URL just in case
$pdo->prepare("UPDATE orders SET payment_url = ? WHERE id = ?")->execute([$pay_url, $order_db_id]);

// Redirect user to Pakasir
header("Location: " . $pay_url);
exit;
