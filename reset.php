<?php
// Load konfigurasi database dari config.php
// Pastikan file .env sudah disetting dengan benar sebelum menjalankan file ini.
require_once 'config.php';

// --- KEAMANAN ---
// Mencegah akses sembarangan. Tambahkan ?key=rahasia123 di URL untuk menjalankan.
// Contoh: domainanda.com/reset.php?key=rahasia123
$security_key = 'rahasia123';

if (!isset($_GET['key']) || $_GET['key'] !== $security_key) {
    http_response_code(403);
    die("<h1>Akses Ditolak 🚫</h1><p>Anda tidak memiliki izin untuk menjalankan file ini.</p>");
}

try {
    // $pdo sudah tersedia dari config.php

    // Password default baru: "admin123"
    $password_baru = password_hash('admin123', PASSWORD_DEFAULT);
    
    // Cek apakah user admin ada di tabel USERS?
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
    $stmt_check->execute();

    if ($stmt_check->fetchColumn() == 0) {
        // Jika tidak ada, kita buat baru
        $sql = "INSERT INTO users (username, name, email, password, role) VALUES ('admin', 'Super Admin', 'admin@example.com', :p, 'admin')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['p' => $password_baru]);
        $action = "dibuat";
    } else {
        // Jika ada, kita update role dan passwordnya
        $sql = "UPDATE users SET password = :p, role = 'admin' WHERE username = 'admin'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['p' => $password_baru]);
        $action = "direset";
    }

    echo "<h1>SUKSES! ✅</h1>";
    echo "User <b>admin</b> berhasil $action.<br>";
    echo "Password saat ini: <b>admin123</b><br>";
    echo "<hr>";
    echo "Silakan coba login di <a href='login.php'>Halaman Login</a>.<br><br>";
    echo "<p style='color:red; font-weight:bold;'>PENTING: Segera hapus file reset.php ini setelah Anda berhasil login demi keamanan!</p>";

} catch (PDOException $e) {
    echo "<h1>GAGAL ❌</h1>";
    echo "Error Database: " . $e->getMessage();
    echo "<br>Pastikan file .env sudah dikonfigurasi dengan benar.";
}
?>
