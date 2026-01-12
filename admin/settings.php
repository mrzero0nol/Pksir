<?php
// admin/settings.php
session_start();
require_once '../config.php';
require_once 'auth_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->execute([$key, $value, $value]);
    }
    $success = "Pengaturan disimpan.";
}

// Fetch current settings
$stmt = $pdo->query("SELECT * FROM site_settings");
$settings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan Situs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Pengaturan Situs</h2>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Judul Situs</label>
            <input type="text" name="site_title" class="form-control" value="<?php echo $settings['site_title'] ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="site_description" class="form-control"><?php echo $settings['site_description'] ?? ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label>WhatsApp Kontak</label>
            <input type="text" name="contact_wa" class="form-control" value="<?php echo $settings['contact_wa'] ?? ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
