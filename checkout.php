<?php
require_once 'config.php';
require_once 'includes/pakasir_api.php';
require_once 'includes/cart_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$cartItems = getCartItems($pdo);
if (empty($cartItems)) {
    die("Keranjang kosong.");
}

$customer_name = $_POST['name'];
$customer_contact = $_POST['contact'];
$voucher_code = trim($_POST['voucher'] ?? '');

// Calculate Total
$total_amount = getCartTotal($pdo);

// Apply Voucher (Only applies to total once for now, or per item? Assuming Total Discount)
// Logic: If voucher is percentage, apply to total. If fixed, apply to total.
$discount = 0;
if ($voucher_code) {
    $vStmt = $pdo->prepare("SELECT * FROM vouchers WHERE code = ? AND status = 'active' AND (usage_limit = 0 OR used_count < usage_limit)");
    $vStmt->execute([$voucher_code]);
    $voucher = $vStmt->fetch();

    if ($voucher) {
        if ($voucher['discount_type'] == 'fixed') {
            $discount = $voucher['discount_value'];
        } else {
            $discount = ($total_amount * $voucher['discount_value']) / 100;
        }
    } else {
        $voucher_code = null;
    }
} else {
    $voucher_code = null;
}

$final_total = $total_amount - $discount;
if ($final_total < 1000) $final_total = 1000;

// Create Invoice ID
$invoice_id = 'INV-' . time() . rand(100, 999);

// Create Orders (Multiple rows for multiple items)
// Note: We need to ensure 'orders' table supports multiple rows with same invoice_id.
// (We attempted to drop UNIQUE index in planning phase).
foreach ($cartItems as $item) {
    // Check stock for each item
    $stock_count = $pdo->query("SELECT COUNT(*) FROM product_stocks WHERE product_id = {$item['id']} AND status = 'available'")->fetchColumn();
    if ($stock_count < $item['qty']) {
        die("Stok tidak cukup untuk produk: " . htmlspecialchars($item['name']));
    }

    $item_total = $item['price'] * $item['qty'];
    // Distribute discount proportionally? Or just store original price and handle total on payment?
    // For simplicity, we store the *item* total price in DB row, but the Payment Gateway request uses the *Final Total*.

    // Insert into orders
    // We added 'quantity' column in the plan.
    $stmt = $pdo->prepare("INSERT INTO orders (invoice_id, product_id, quantity, customer_name, customer_contact, total_amount, voucher_code, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$invoice_id, $item['id'], $item['qty'], $customer_name, $customer_contact, $item_total, $voucher_code]);
}

// Generate Payment URL
$redirect_url = APP_URL . "/status.php?inv=" . $invoice_id;
$pay_url = "https://app.pakasir.com/pay/" . PAKASIR_PROJECT_SLUG . "/" . (int)$final_total . "?order_id=" . $invoice_id . "&redirect=" . urlencode($redirect_url) . "&qris_only=1";

// We might want to update the first order row with payment URL or just rely on invoice_id
$pdo->prepare("UPDATE orders SET payment_url = ? WHERE invoice_id = ?")->execute([$pay_url, $invoice_id]);

// Clear Cart
clearCart();

// Redirect
header("Location: " . $pay_url);
exit;
