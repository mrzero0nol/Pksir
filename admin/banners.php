<?php
// admin/banners.php
session_start();
require_once '../config.php';
require_once 'auth_check.php';

// Handle Add
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO banners (image_url, link_url, sort_order) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['image_url'], $_POST['link_url'], $_POST['sort_order']]);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM banners WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: banners.php');
    exit;
}

$banners = $pdo->query("SELECT * FROM banners ORDER BY sort_order ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Kelola Banner</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5>Tambah Banner</h5>
            <form method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <input type="url" name="image_url" class="form-control" placeholder="URL Gambar" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="link_url" class="form-control" placeholder="Link Tujuan">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="sort_order" class="form-control" placeholder="Urutan" value="0">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead><tr><th>Image</th><th>Link</th><th>Order</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach ($banners as $b): ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($b['image_url']); ?>" height="50"></td>
                <td><?php echo htmlspecialchars($b['link_url']); ?></td>
                <td><?php echo $b['sort_order']; ?></td>
                <td><a href="?delete=<?php echo $b['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</body>
</html>
