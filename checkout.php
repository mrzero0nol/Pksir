<?php
require_once 'config.php';
require_once 'includes/pakasir_api.php';
require_once 'includes/cart_helper.php';

// Check if user is logged in (Optional, but good for tracking)
// If not logged in, we can still allow checkout but maybe ask for email manually?
// Current register.php exists, so we assume they should be logged in or we ask for details.
// For simplicity, if not logged in, redirect to login? Or allow guest.
// Let's implement Guest Checkout with form.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process Checkout
    $customer_name = $_POST['name'];
    $customer_contact = $_POST['contact'];
    // $voucher_code = trim($_POST['voucher'] ?? ''); // Global voucher not implemented for cart yet

    $cartItems = getCartItems($pdo);
    if (empty($cartItems)) {
        die("Keranjang kosong.");
    }

    // Calculate Total & Validate Stock
    $grandTotal = 0;
    $invoice_id = 'INV-' . time() . rand(100, 999);
    $finalItems = [];

    // Verify stock for all items first
    foreach ($cartItems as $item) {
        $qty = $item['qty'];
        $product_id = $item['id'];

        $stock_count = $pdo->prepare("SELECT COUNT(*) FROM product_stocks WHERE product_id = ? AND status = 'available'");
        $stock_count->execute([$product_id]);
        $avail = $stock_count->fetchColumn();

        if ($avail < $qty) {
            die("Stok untuk " . htmlspecialchars($item['name']) . " tidak mencukupi (Tersedia: $avail, Diminta: $qty).");
        }

        $grandTotal += $item['price'] * $qty;
        $finalItems[] = $item;
    }

    if ($grandTotal < 1000) $grandTotal = 1000;

    // Begin Transaction
    $pdo->beginTransaction();
    try {
        $pay_url = "";
        $redirect_url = APP_URL . "/status.php?inv=" . $invoice_id;
        // Since Pakasir takes 1 redirect URL for the whole payment.

        foreach ($finalItems as $item) {
            // Insert 1 row per UNIT or per PRODUCT?
            // Schema: `orders` has `product_id`.
            // If user bought 2 of Product A, we can insert 2 rows or 1 row with price * 2?
            // Usually 1 row per unit is better for stock assignment (1 row = 1 stock).
            // Let's insert N rows for N qty.
            for ($i = 0; $i < $item['qty']; $i++) {
                 $stmt = $pdo->prepare("INSERT INTO orders (invoice_id, product_id, customer_name, customer_contact, total_amount, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                 // We split total amount? No, total_amount in orders usually means "Price paid for this item" or "Total Invoice"?
                 // The `orders` table seems to act as both Header and Line Item.
                 // If I put `total_amount` as the Unit Price, `webhook.php` needs to know the GRAND TOTAL.
                 // Pakasir sends `amount` (Grand Total).
                 // In `webhook.php`, we check `orders` where `invoice_id`.
                 // If we have multiple rows, does `total_amount` matter there?
                 // `webhook.php` does: `UPDATE orders SET status='paid'`. It updates ALL rows.
                 // So we should store UNIT PRICE in `total_amount` for record keeping?
                 // Or we store Grand Total in every row? That's confusing.
                 // Let's store UNIT PRICE.
                 $stmt->execute([$invoice_id, $item['id'], $customer_name, $customer_contact, $item['price']]);
            }
        }

        // Generate Pakasir URL
        // Amount must be Grand Total
        $pay_url = "https://app.pakasir.com/pay/" . PAKASIR_PROJECT_SLUG . "/" . (int)$grandTotal . "?order_id=" . $invoice_id . "&redirect=" . urlencode($redirect_url) . "&qris_only=1";

        // Update payment_url for all rows (optional, but good for reference)
        $pdo->prepare("UPDATE orders SET payment_url = ? WHERE invoice_id = ?")->execute([$pay_url, $invoice_id]);

        $pdo->commit();

        // Clear Cart
        unset($_SESSION['cart']);

        // Redirect
        header("Location: " . $pay_url);
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Terjadi kesalahan database: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header">Checkout</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required value="<?php echo $_SESSION['user_name'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label>No. WhatsApp / Email</label>
                        <input type="text" name="contact" class="form-control" required value="<?php echo $_SESSION['user_contact'] ?? ''; ?>">
                        <small class="text-muted">Akun/Voucher akan dikirim ke sini.</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
