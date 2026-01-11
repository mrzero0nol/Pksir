<?php
require_once '../config.php';
require_once 'auth_check.php';

// Handle Category Addition
if (isset($_POST['add_category'])) {
    $name = $_POST['category_name'];
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);
    header("Location: products.php");
    exit;
}

// Handle Product Addition
if (isset($_POST['add_product'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("INSERT INTO products (category_id, name, description, price, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$category_id, $name, $description, $price, $image_url]);
    header("Location: products.php");
    exit;
}

// Handle Product Deletion
if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: products.php");
    exit;
}

// Fetch Data
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$products = $pdo->query("SELECT p.*, c.name as category_name,
    (SELECT COUNT(*) FROM product_stocks s WHERE s.product_id = p.id AND s.status = 'available') as stock_count
    FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
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
            <h2>Manajemen Produk & Kategori</h2>

            <div class="row">
                <!-- Add Category -->
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Tambah Kategori</h5>
                        <form method="POST">
                            <div class="mb-2">
                                <input type="text" name="category_name" class="form-control" placeholder="Nama Kategori" required>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-secondary w-100">Tambah</button>
                        </form>
                    </div>
                </div>

                <!-- Add Product -->
                <div class="col-md-8">
                    <div class="card p-3">
                        <h5>Tambah Produk Baru</h5>
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input type="number" name="price" class="form-control" placeholder="Harga" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input type="text" name="image_url" class="form-control" placeholder="URL Gambar (https://...)" required>
                                </div>
                                <div class="col-12 mb-2">
                                    <textarea name="description" class="form-control" placeholder="Deskripsi Produk"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-primary w-100">Simpan Produk</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Product List -->
            <div class="card p-3">
                <h5>Daftar Produk</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['category_name']) ?></td>
                            <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $p['stock_count'] > 0 ? 'success' : 'danger' ?>">
                                    <?= $p['stock_count'] ?> Item
                                </span>
                            </td>
                            <td>
                                <a href="stock_manage.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-info text-white">Atur Stok</a>
                                <a href="?delete_product=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>
