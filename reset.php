<?php
// Masukkan data database Anda di sini (sama seperti config.php)
$host = 'localhost';
$db   = 'digitapr_shop';
$user = 'digitapr_user';
$pass = '(MwllMTv3*9gDpO!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kita set password baru: "admin123"
    // Script ini otomatis memakai format enkripsi yang sesuai dengan hosting Anda
    $password_baru = password_hash('admin123', PASSWORD_DEFAULT);
    
    // Update database
    $sql = "UPDATE admins SET password = :p WHERE username = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['p' => $password_baru]);

    echo "<h1>SUKSES! ✅</h1>";
    echo "Password untuk user <b>admin</b> berhasil direset menjadi: <b>admin123</b><br>";
    echo "Silakan coba login sekarang.";

} catch (PDOException $e) {
    echo "<h1>GAGAL ❌</h1>";
    echo "Error: " . $e->getMessage();
}
?>
