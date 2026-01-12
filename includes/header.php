<?php
// Ensure $settings is available
if (!isset($settings)) {
    // We assume $pdo is available from config.php included in parent page
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = 'site_title'");
        $stmt->execute();
        $siteTitle = $stmt->fetchColumn();
        $settings['site_title'] = $siteTitle ?: 'Toko Digital';
    } else {
        $settings['site_title'] = 'Toko Digital';
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <?php echo htmlspecialchars($settings['site_title']); ?>
        </a>
        <div class="d-flex">
            <?php if(isLoggedIn()): ?>
                <a href="cart.php" class="btn btn-outline-primary position-relative me-2">
                    <i class="bi bi-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo getCartCount(); ?>
                    </span>
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
