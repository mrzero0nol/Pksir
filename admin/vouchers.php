<?php
require_once '../config.php';
require_once 'auth_check.php';

// Add Voucher
if (isset($_POST['add_voucher'])) {
    $code = strtoupper($_POST['code']);
    $type = $_POST['type'];
    $value = $_POST['value'];
    $limit = $_POST['limit'];

    $stmt = $pdo->prepare("INSERT INTO vouchers (code, discount_type, discount_value, usage_limit) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$code, $type, $value, $limit]);
    } catch (Exception $e) {
        $error = "Gagal menambah voucher. Kode mungkin sudah ada.";
    }
}

// Delete Voucher
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM vouchers WHERE id = ?")->execute([$id]);
    header("Location: vouchers.php");
    exit;
}

$vouchers = $pdo->query("SELECT * FROM vouchers ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Voucher</title>
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
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" class="text-danger">Logout</a>
        </div>
        <div class="content flex-grow-1">
            <h2>Manajemen Voucher</h2>

            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Buat Voucher Baru</h5>
                        <?php if (isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
                        <form method="POST">
                            <div class="mb-2">
                                <label>Kode Voucher</label>
                                <input type="text" name="code" class="form-control" style="text-transform:uppercase" required>
                            </div>
                            <div class="mb-2">
                                <label>Tipe Diskon</label>
                                <select name="type" class="form-control">
                                    <option value="fixed">Potongan Harga (Rp)</option>
                                    <option value="percent">Persentase (%)</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Nilai Diskon</label>
                                <input type="number" name="value" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Batas Penggunaan</label>
                                <input type="number" name="limit" class="form-control" value="100" required>
                            </div>
                            <button type="submit" name="add_voucher" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card p-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Diskon</th>
                                    <th>Digunakan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vouchers as $v): ?>
                                <tr>
                                    <td><?= htmlspecialchars($v['code']) ?></td>
                                    <td>
                                        <?= $v['discount_type'] == 'fixed' ? 'Rp '.number_format($v['discount_value']) : $v['discount_value'].'%' ?>
                                    </td>
                                    <td><?= $v['used_count'] ?> / <?= $v['usage_limit'] ?></td>
                                    <td>
                                        <a href="?delete=<?= $v['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus voucher?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
