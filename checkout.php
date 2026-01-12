<?php
require_once 'config.php';
require_once 'includes/pakasir_api.php';
require_once 'includes/cart_helper.php';
require_once 'includes/auth_helper.php';

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
$use_wallet = isset($_POST['use_wallet']) ? true : false;
$user = getCurrentUser($pdo);

// Calculate Total
$total_amount = getCartTotal($pdo);

// Apply Voucher
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
if ($final_total < 0) $final_total = 0; // Free if voucher covers it? Qris min 1000

// Create Invoice ID
$invoice_id = 'INV-' . time() . rand(100, 999);
$user_id = $user ? $user['id'] : null;

// STOCK CHECK
foreach ($cartItems as $item) {
    $stock_count = $pdo->query("SELECT COUNT(*) FROM product_stocks WHERE product_id = {$item['id']} AND status = 'available'")->fetchColumn();
    if ($stock_count < $item['qty']) {
        die("Stok tidak cukup untuk produk: " . htmlspecialchars($item['name']));
    }
}

// WALLET PAYMENT LOGIC
$payment_method = 'qris';
$status = 'pending';

if ($use_wallet && $user) {
    if ($user['balance'] >= $final_total) {
        $payment_method = 'wallet';
        $status = 'paid';
    } else {
        die("Saldo wallet tidak cukup.");
    }
}

// IF USING QRIS, MIN AMOUNT IS 1000
if ($payment_method == 'qris' && $final_total < 1000) {
    $final_total = 1000;
}

// INSERT ORDERS
$pdo->beginTransaction();
try {
    foreach ($cartItems as $item) {
        $item_total = $item['price'] * $item['qty']; // Individual total, not discounted

        $stmt = $pdo->prepare("INSERT INTO orders (invoice_id, user_id, product_id, quantity, customer_name, customer_contact, total_amount, voucher_code, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$invoice_id, $user_id, $item['id'], $item['qty'], $customer_name, $customer_contact, $item_total, $voucher_code, $status]);
    }

    if ($payment_method == 'wallet') {
        // Deduct Balance
        $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?")->execute([$final_total, $user_id]);

        // Record Transaction
        $pdo->prepare("INSERT INTO wallet_transactions (user_id, type, amount, description, status, invoice_id) VALUES (?, 'purchase', ?, ?, 'success', ?)")
            ->execute([$user_id, $final_total, "Pembelian Invoice #$invoice_id", $invoice_id]);

        // Process Stock Assignment (Immediate)
        // Similar logic to Webhook
        foreach ($cartItems as $item) {
             // Select stock
             $stockStmt = $pdo->prepare("SELECT id FROM product_stocks WHERE product_id = ? AND status = 'available' LIMIT ? FOR UPDATE");
             $stockStmt->bindValue(1, $item['id'], PDO::PARAM_INT);
             $stockStmt->bindValue(2, $item['qty'], PDO::PARAM_INT);
             $stockStmt->execute();
             $stocks = $stockStmt->fetchAll();

             // Assign
             foreach ($stocks as $s) {
                 // Get Order ID for this specific row in orders table... wait, we have multiple rows with same invoice_id.
                 // We need to link specific order row.
                 // Ideally, we fetch the specific order row ID we just inserted.
                 // But since invoice_id is shared, we can look up order row by product_id + invoice_id
                 $oStmt = $pdo->prepare("SELECT id FROM orders WHERE invoice_id = ? AND product_id = ? LIMIT 1");
                 $oStmt->execute([$invoice_id, $item['id']]);
                 $orderRow = $oStmt->fetch();

                 $pdo->prepare("UPDATE product_stocks SET status = 'sold', order_id = ? WHERE id = ?")->execute([$orderRow['id'], $s['id']]);
             }
        }

        if ($voucher_code) {
             $pdo->prepare("UPDATE vouchers SET used_count = used_count + 1 WHERE code = ?")->execute([$voucher_code]);
        }

        $redirect_url = "status.php?inv=" . $invoice_id; // Go straight to status

    } else {
        // QRIS PAYMENT
        $redirect_url = APP_URL . "/status.php?inv=" . $invoice_id;
        $pay_url = "https://app.pakasir.com/pay/" . PAKASIR_PROJECT_SLUG . "/" . (int)$final_total . "?order_id=" . $invoice_id . "&redirect=" . urlencode($redirect_url) . "&qris_only=1";

        // Update URL
        $pdo->prepare("UPDATE orders SET payment_url = ? WHERE invoice_id = ?")->execute([$pay_url, $invoice_id]);

        $redirect_url = $pay_url;
    }

    $pdo->commit();
    clearCart();

    header("Location: " . $redirect_url);
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error Processing Order: " . $e->getMessage());
}
