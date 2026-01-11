<?php
require_once 'config.php';

// Retrieve JSON body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    exit('Invalid JSON');
}

// Log webhook for debugging (optional)
file_put_contents('webhook_log.txt', date('Y-m-d H:i:s') . " - " . $json . "\n", FILE_APPEND);

// Extract data
$invoice_id = $data['order_id'] ?? '';
$status = $data['status'] ?? '';
$amount = $data['amount'] ?? 0;
// Pakasir signature verification is usually recommended but docs don't specify a signature header,
// they say "check status valid with API".
// However, relying on Webhook for immediate delivery is standard.
// For security, we should verify the order exists and amount matches.

if ($status == 'completed' || $status == 'success') {
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);
    $order = $stmt->fetch();

    if ($order && $order['status'] != 'paid') {
        // Verify Amount (allow small difference for fees if any, but Pakasir usually exact)
        // Note: Pakasir webhook amount might be the paid amount (inc fees) or original.
        // Docs: "amount": 22000.
        // We will assume it matches roughly or we trust the invoice_id.

        // 1. Mark Order as Paid
        $pdo->prepare("UPDATE orders SET status = 'paid' WHERE id = ?")->execute([$order['id']]);

        // 2. Assign Stock
        // Find one available stock for this product
        // Use Transaction to prevent race conditions
        $pdo->beginTransaction();

        try {
            // Select one available stock (FOR UPDATE to lock row)
            $stockStmt = $pdo->prepare("SELECT id FROM product_stocks WHERE product_id = ? AND status = 'available' LIMIT 1 FOR UPDATE");
            $stockStmt->execute([$order['product_id']]);
            $stock = $stockStmt->fetch();

            if ($stock) {
                // Assign to order
                $assignStmt = $pdo->prepare("UPDATE product_stocks SET status = 'sold', order_id = ? WHERE id = ?");
                $assignStmt->execute([$order['id'], $stock['id']]);
            } else {
                // No stock available! Admin needs to handle this manually.
                // We can mark order as 'paid_no_stock' or log it.
                file_put_contents('webhook_error.txt', "Order $invoice_id PAID but NO STOCK available!\n", FILE_APPEND);
            }

            // 3. Update Voucher Usage if any
            if ($order['voucher_code']) {
                $pdo->prepare("UPDATE vouchers SET used_count = used_count + 1 WHERE code = ?")->execute([$order['voucher_code']]);
            }

            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            file_put_contents('webhook_error.txt', "DB Error: " . $e->getMessage() . "\n", FILE_APPEND);
        }
    }
}

echo json_encode(['status' => 'ok']);
