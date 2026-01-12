<?php
// Installer Script for Digital Premium Shop

$message = '';
$error = false;

if (file_exists('.env')) {
    $message = "Sistem tampaknya sudah terinstall (File .env ditemukan). Jika ingin install ulang, silakan hapus file .env terlebih dahulu.";
    $error = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$error) {
    $host = $_POST['host'];
    $db_name = $_POST['db_name'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $app_url = $_POST['app_url'];
    $pakasir_key = $_POST['pakasir_key'];
    $pakasir_slug = $_POST['pakasir_slug'];
    $admin_user = $_POST['admin_user'];
    $admin_pass = $_POST['admin_pass'];

    // 1. Try Connection
    try {
        $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create DB if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
        $pdo->exec("USE `$db_name`");

        // 2. Import SQL
        $sql = file_get_contents('sql/database.sql');
        $pdo->exec($sql);

        // 3. Create Admin
        $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("DELETE FROM admins WHERE username = ?");
        $stmt->execute([$admin_user]); // Remove if exists (re-install scenario on same DB)

        $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->execute([$admin_user, $hash]);

        // 4. Write .env
        $env_content = "DB_HOST=$host\n";
        $env_content .= "DB_NAME=$db_name\n";
        $env_content .= "DB_USER=$user\n";
        $env_content .= "DB_PASS=$pass\n";
        $env_content .= "APP_URL=$app_url\n";
        $env_content .= "PAKASIR_API_KEY=$pakasir_key\n";
        $env_content .= "PAKASIR_PROJECT_SLUG=$pakasir_slug\n";

        file_put_contents('.env', $env_content);

        $message = "Instalasi Berhasil! Silakan hapus file install.php demi keamanan.";
        $error = false;

    } catch (PDOException $e) {
        $message = "Gagal menghubungkan ke database: " . $e->getMessage();
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer - Digital Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .install-card { max-width: 600px; margin: 50px auto; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card install-card">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Web Installer</h4>
            </div>
            <div class="card-body p-4">
                <?php if ($message): ?>
                    <div class="alert alert-<?= $error ? 'danger' : 'success' ?>">
                        <?= $message ?>
                        <?php if (!$error): ?>
                            <br><a href="index.php" class="btn btn-success mt-2">Buka Website</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!$error && !file_exists('.env')): ?>
                <form method="POST">
                    <h5 class="mb-3 text-primary">Database & App</h5>
                    <div class="mb-3">
                        <label>Database Host</label>
                        <input type="text" name="host" class="form-control" value="localhost" required>
                    </div>
                    <div class="mb-3">
                        <label>Database Name</label>
                        <input type="text" name="db_name" class="form-control" value="shop_db" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>DB User</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label>DB Password</label>
                            <input type="text" name="pass" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>App URL (Contoh: https://toko.com)</label>
                        <input type="url" name="app_url" class="form-control" required value="http://<?= $_SERVER['HTTP_HOST'] ?>">
                    </div>

                    <h5 class="mb-3 mt-4 text-primary">Pakasir Gateway (QRIS)</h5>
                    <div class="mb-3">
                        <label>Pakasir Project Slug</label>
                        <input type="text" name="pakasir_slug" class="form-control" placeholder="slug-project-anda">
                    </div>
                    <div class="mb-3">
                        <label>Pakasir API Key (Optional)</label>
                        <input type="text" name="pakasir_key" class="form-control">
                    </div>

                    <h5 class="mb-3 mt-4 text-primary">Admin Account</h5>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="admin_user" class="form-control" value="admin" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="admin_pass" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Install Sekarang</button>
                </form>
                <?php elseif(file_exists('.env') && !$message): ?>
                    <div class="alert alert-warning">
                        File configuration (.env) sudah ada. Mohon hapus manual jika ingin install ulang.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
