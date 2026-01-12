<nav class="bottom-nav glass-nav">
    <a href="index.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
        <i class="bi bi-house"></i>
        <span>Home</span>
    </a>
    <a href="history.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'history.php' ? 'active' : '' ?>">
        <i class="bi bi-clock-history"></i>
        <span>History</span>
    </a>
    <a href="wallet.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'wallet.php' ? 'active' : '' ?>">
        <i class="bi bi-wallet2"></i>
        <span>Wallet</span>
    </a>
    <a href="cart.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : '' ?>">
        <i class="bi bi-bag"></i>
        <span>Cart</span>
    </a>
    <a href="profile.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
        <i class="bi bi-person"></i>
        <span>Profile</span>
    </a>
</nav>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
