<?php
// Update Script
// Gunakan script ini setelah menimpa file lama dengan file baru.

require_once 'config.php';

echo "<h3>Update Utility</h3>";
echo "<pre>";

try {
    // 1. Check Connection
    echo "[INFO] Testing Database Connection... ";
    $pdo->query("SELECT 1");
    echo "OK\n";

    // 2. Check Tables (Simple Migration Logic)
    $tables = ['admins', 'categories', 'products', 'product_stocks', 'vouchers', 'orders'];
    $existing_tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        if (!in_array($table, $existing_tables)) {
            echo "[WARN] Table '$table' missing. Please run install.php or check sql/database.sql.\n";
        } else {
            echo "[OK] Table '$table' exists.\n";
        }
    }

    // 3. Specific Column Checks (If we added any new columns in this version)
    // Example: Check if 'orders' has 'payment_url'
    $cols = $pdo->query("SHOW COLUMNS FROM orders LIKE 'payment_url'")->fetchAll();
    if (count($cols) == 0) {
        echo "[FIX] Adding 'payment_url' to orders table...\n";
        $pdo->exec("ALTER TABLE orders ADD COLUMN payment_url TEXT AFTER status");
        echo "[DONE] Column added.\n";
    }

    echo "\n[SUCCESS] Update Check Complete. Database is compatible with this version.\n";
    echo "<a href='index.php'>Kembali ke Website</a>";

} catch (PDOException $e) {
    echo "\n[ERROR] Database Error: " . $e->getMessage();
}
echo "</pre>";
