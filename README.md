# Toko Produk Digital (PHP Native)

Sebuah website toko online untuk produk digital (akun, voucher, item game) dengan sistem pembayaran otomatis via Pakasir (QRIS) dan pengiriman stok otomatis.

## Fitur
- **Auto Installer**: Mudah diinstall di cPanel/Hosting.
- **Produk Digital**: Menjual akun/voucher dengan stok otomatis.
- **Pembayaran QRIS**: Integrasi Pakasir.
- **User Dashboard**: Riwayat pembelian untuk member.
- **Admin Panel**: Kelola produk, stok, voucher, banner, dan pengaturan situs.

## Cara Install (Baru)

1. **Upload File**: Upload semua file ke hosting (public_html) atau folder tujuan.
2. **Akses Website**: Buka domain anda di browser (contoh: `https://tokoanda.com`).
3. **Installer**: Halaman installer akan muncul otomatis.
   - Isi detail Database (Host, User, Password, Nama DB).
   - Klik "Install Sekarang".
4. **Selesai**: Website siap digunakan. Login admin default (jika ada) atau buat via database.

## Cara Update

Jika anda sudah memiliki versi lama dan ingin update:

1. Backup file `.env` dan database anda.
2. Timpa file lama dengan file baru (Kecuali `.env`).
3. Import file `sql/update_v2.sql` ke database anda via phpMyAdmin (File ini berisi tabel baru dan perubahan struktur tabel order).
4. Cek folder `install/` jika diperlukan.

## Struktur Folder
- `admin/`: Halaman admin.
- `includes/`: Logika backend (auth, cart, api).
- `install/`: Script installer.
- `assets/`: CSS/JS/Images.
- `sql/`: File database.
