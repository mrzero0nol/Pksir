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

if ($status == 'completed' || $status == 'success') {

    // Check if this is a Wallet Top Up
    if (strpos($invoice_id, 'TOP-') === 0) {
        $stmt = $pdo->prepare("SELECT * FROM wallet_transactions WHERE invoice_id = ? AND status = 'pending'");
        $stmt->execute([$invoice_id]);
        $trx = $stmt->fetch();

        if ($trx) {
            $pdo->beginTransaction();
            try {
                // Update Transaction Status
                $pdo->prepare("UPDATE wallet_transactions SET status = 'success' WHERE id = ?")->execute([$trx['id']]);

                // Add Balance to User
                $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?")->execute([$trx['amount'], $trx['user_id']]);

                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                file_put_contents('webhook_error.txt', "Wallet Topup Error: " . $e->getMessage() . "\n", FILE_APPEND);
            }
        }

        echo json_encode(['status' => 'ok']);
        exit;
    }

    // Otherwise, it's a Product Order
    // Handle multiple items sharing the same invoice_id
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE invoice_id = ? AND status = 'pending'");
    $stmt->execute([$invoice_id]);
    $orders = $stmt->fetchAll();

    if ($orders) {
        $pdo->beginTransaction();
        try {
            foreach ($orders as $order) {
                // 1. Mark Order as Paid
                $pdo->prepare("UPDATE orders SET status = 'paid' WHERE id = ?")->execute([$order['id']]);

                // 2. Assign Stock
                // Order quantity is in $order['quantity']
                $qty = $order['quantity'] ?? 1;

                // Select available stocks (FOR UPDATE to lock rows)
                $stockStmt = $pdo->prepare("SELECT id FROM product_stocks WHERE product_id = ? AND status = 'available' LIMIT ? FOR UPDATE");
                $stockStmt->bindValue(1, $order['product_id'], PDO::PARAM_INT);
                $stockStmt->bindValue(2, $qty, PDO::PARAM_INT);
                $stockStmt->execute();
                $stocks = $stockStmt->fetchAll();

                if (count($stocks) == $qty) {
                    // Assign all stocks to this order
                    $stockIds = array_column($stocks, 'id');
                    $inQuery = implode(',', array_fill(0, count($stockIds), '?'));
                    $assignStmt = $pdo->prepare("UPDATE product_stocks SET status = 'sold', order_id = ? WHERE id IN ($inQuery)");
                    $assignStmt->execute(array_merge([$order['id']], $stockIds));
                } else {
                    // Partial or No stock available!
                    // Log it, but don't fail the transaction (money is already paid).
                    file_put_contents('webhook_error.txt', "Order $invoice_id Product {$order['product_id']} PAID but Insufficient STOCK!\n", FILE_APPEND);
                }
            }

            // 3. Update Voucher Usage (Only once per invoice? Or per row? Usually once per code)
            // Assuming voucher_code is same for all rows, we just increment once.
            if ($orders[0]['voucher_code']) {
                 $pdo->prepare("UPDATE vouchers SET used_count = used_count + 1 WHERE code = ?")->execute([$orders[0]['voucher_code']]);
            }

            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            file_put_contents('webhook_error.txt', "DB Error: " . $e->getMessage() . "\n", FILE_APPEND);
        }
    }
}

echo json_encode(['status' => 'ok']);
