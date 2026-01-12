<nav class="bottom-nav">
    <a href="#" class="nav-item">
        <i class="bi bi-chat-dots"></i>
        <span>Chat</span>
    </a>
    <a href="history.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'history.php' ? 'active' : '' ?>">
        <i class="bi bi-clock-history"></i>
        <span>Riwayat</span>
    </a>
    <a href="wallet.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'wallet.php' ? 'active' : '' ?>">
        <i class="bi bi-wallet2"></i>
        <span>Aset</span>
    </a>
    <a href="cart.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : '' ?>">
        <i class="bi bi-cart"></i>
        <span>Keranjang</span>
    </a>
    <a href="index.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
        <i class="bi bi-bag"></i>
        <span>Belanja</span>
    </a>
    <a href="profile.php" class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
        <i class="bi bi-person"></i>
        <span>Saya</span>
    </a>
</nav>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
