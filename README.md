# Digital Premium Shop - Toko Produk Digital Modern

Aplikasi toko online berbasis PHP Native (Tanpa Framework) yang ringan, cepat, dan mudah dikelola. Didesain khusus untuk menjual produk digital seperti Akun Premium, Voucher Game, Token, dan Lisensi Software dengan sistem pengiriman stok otomatis setelah pembayaran QRIS (Pakasir).

## 🌟 Fitur Utama

### Frontend (Pelanggan)
*   **Modern UI**: Tampilan bersih dan responsif (Mobile Friendly) mirip aplikasi native.
*   **Kategori Tabs**: Filter produk berdasarkan kategori tanpa reload halaman yang berat.
*   **Cek Pesanan (Track Order)**: Cek status pembelian dan lihat kredensial produk (Email/Pass) cukup dengan Nomor Invoice atau No. HP.
*   **Stok Real-time**: Indikator stok tersedia atau habis.
*   **Checkout Cepat**: Integrasi langsung ke pembayaran QRIS.

### Backend (Admin)
*   **Dashboard**: Statistik penjualan harian/bulanan.
*   **Manajemen Produk**: Tambah/Edit/Hapus produk dan kategori.
*   **Manajemen Stok**: Sistem "Gudang Akun". Input banyak akun sekaligus, sistem akan otomatis mengirim 1 akun per pembelian sukses.
*   **Voucher**: Buat kode promo diskon (Fixed atau Persen).
*   **Riwayat Transaksi**: Pantau semua pesanan masuk.

---

## 🚀 Panduan Installasi (Otomatis)

1.  **Upload File**
    *   Upload semua file ke hosting Anda (folder `public_html`).
2.  **Siapkan Database**
    *   Buat Database baru di cPanel (MySQL Database Wizard).
    *   Catat: `Nama Database`, `User Database`, dan `Password`.
3.  **Jalankan Installer**
    *   Buka website Anda di browser: `https://domainanda.com/install.php`
    *   Isi formulir dengan detail database yang sudah dibuat.
    *   Klik **Install Sekarang**.
4.  **Selesai!**
    *   Website siap digunakan.
    *   **PENTING:** Hapus file `install.php` dari File Manager demi keamanan.

---

## 🔄 Cara Update Script

Jika Anda mendapatkan file update terbaru (misalnya perbaikan bug atau fitur baru):

1.  **Backup** file `.env` (atau catat isinya) dan backup database Anda.
2.  **Upload & Timpa (Overwrite)** semua file lama dengan file baru.
3.  **Jalankan Updater**:
    *   Buka `https://domainanda.com/update.php`
    *   Script akan otomatis memeriksa dan memperbaiki struktur database jika ada perubahan.
4.  **Selesai!** Hapus `update.php` jika sudah tidak diperlukan.

---

## ⚙️ Konfigurasi Manual (Jika Install Otomatis Gagal)

Jika `install.php` gagal, Anda bisa konfigurasi manual:

1.  Rename `.env.example` menjadi `.env`.
2.  Edit `.env` dan isi detail database:
    ```ini
    DB_HOST=localhost
    DB_NAME=nama_db_anda
    DB_USER=user_db_anda
    DB_PASS=password_db_anda
    APP_URL=https://domainanda.com
    PAKASIR_PROJECT_SLUG=slug-project-pakasir
    ```
3.  Import file `sql/database.sql` ke database Anda via phpMyAdmin.

---

## 👤 Akun Admin Default

Setelah installasi berhasil, gunakan akun berikut untuk login ke `/admin/login.php`:

*   **Username:** `admin`
*   **Password:** Masukkan password yang Anda buat saat proses installasi (atau default `admin123` jika manual).

---

## 🛠️ Integrasi Pembayaran (Pakasir)

Agar pembayaran otomatis terdeteksi:

1.  Login ke [Pakasir.com](https://pakasir.com).
2.  Buat Project baru.
3.  Masuk ke **Settings > Webhook**.
4.  Isi **Webhook URL** dengan: `https://domainanda.com/webhook.php`
5.  Simpan.

---

**Catatan:** Aplikasi ini berjalan di PHP 7.4 atau lebih baru. Pastikan ekstensi `pdo_mysql` aktif di hosting Anda.
