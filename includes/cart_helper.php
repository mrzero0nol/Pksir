<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addToCart($product_id, $qty = 1) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $qty;
    } else {
        $_SESSION['cart'][$product_id] = $qty;
    }
}

function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

function updateCartQty($product_id, $qty) {
    if ($qty <= 0) {
        removeFromCart($product_id);
    } else {
        $_SESSION['cart'][$product_id] = $qty;
    }
}

function getCartItems($pdo) {
    if (empty($_SESSION['cart'])) return [];

    $ids = array_keys($_SESSION['cart']);
    $in = str_repeat('?,', count($ids) - 1) . '?';

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($in)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as &$p) {
        $p['qty'] = $_SESSION['cart'][$p['id']];
        $p['subtotal'] = $p['price'] * $p['qty'];
    }

    return $products;
}

function getCartTotal($pdo) {
    $items = getCartItems($pdo);
    $total = 0;
    foreach ($items as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}

function clearCart() {
    $_SESSION['cart'] = [];
}
