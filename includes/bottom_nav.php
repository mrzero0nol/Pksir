<div class="bottom-nav">
    <a href="index.php" class="nav-item-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
        <i class="bi bi-house"></i>
        <span>Home</span>
    </a>
    <a href="cart.php" class="nav-item-link <?php echo basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : ''; ?>">
        <i class="bi bi-cart"></i>
        <span>Cart</span>
    </a>
    <a href="user/index.php" class="nav-item-link <?php echo strpos($_SERVER['PHP_SELF'], 'user/') !== false ? 'active' : ''; ?>">
        <i class="bi bi-person"></i>
        <span>Akun</span>
    </a>
</div>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
