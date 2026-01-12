<?php
require_once '../config.php';
require_once 'auth_check.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "Semua kolom harus diisi.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Konfirmasi password baru tidak cocok.";
    } else {
        // Ambil ID user dari session yang sedang login
        $user_id = $_SESSION['user_id'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if ($user && password_verify($current_password, $user['password'])) {
            // Password lama benar, update ke yang baru
            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($update->execute([$new_hash, $user_id])) {
                $message = "Password berhasil diubah!";
            } else {
                $error = "Gagal mengupdate database.";
            }
        } else {
            $error = "Password lama salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4>Admin Panel</h4>
            <a href="index.php">Dashboard</a>
            <a href="products.php">Produk & Kategori</a>
            <a href="vouchers.php">Voucher</a>
            <a href="settings.php" class="active">Pengaturan</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" class="text-danger">Logout</a>
        </div>
        <div class="content flex-grow-1">
            <h2>Pengaturan Akun</h2>

            <div class="card p-4 mt-3" style="max-width: 500px;">
                <h5 class="mb-3">Ganti Password Saya</h5>

                <?php if ($message): ?>
                    <div class="alert alert-success"><?= $message ?></div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Password Lama</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
