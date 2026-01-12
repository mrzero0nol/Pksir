# Panduan Installasi Website Toko Produk Digital (PHP & cPanel)

Website ini adalah toko online produk digital (seperti akun premium, voucher, lisensi) yang terintegrasi dengan Payment Gateway **Pakasir** (QRIS).

## Fitur Baru (Versi Light Theme)
- **Tampilan Baru**: Desain modern (Light Theme) ala aplikasi mobile.
- **Login Terpadu**: Login User dan Admin dalam satu pintu (menggunakan Username).
- **Admin via Profil**: Menu admin dapat diakses melalui halaman profil setelah login.

---

## Cara Install di cPanel (Hosting)

### Langkah 1: Persiapan Database
1. Login ke **cPanel**.
2. Buka menu **MySQL® Database Wizard**.
3. Buat Database baru (misal: `namadomain_shop`).
4. Buat User Database baru (misal: `namadomain_user`) dan Password.
5. Hubungkan User ke Database dan centang **ALL PRIVILEGES**.
6. Buka menu **phpMyAdmin**, pilih database yang baru dibuat.
7. Klik tab **Import**, pilih file `sql/database.sql` dari folder proyek ini, lalu klik **Go**.
   > **PERINGATAN:** Langkah ini hanya untuk instalasi baru. Jika database sudah ada isinya, semua data akan terhapus!

### Langkah 2: Upload File
1. Buka **File Manager** di cPanel.
2. Masuk ke folder `public_html`.
3. Upload semua file website ini.

### Langkah 3: Konfigurasi
1. Di File Manager, cari file bernama `.env.example`.
2. Rename (ganti nama) file tersebut menjadi `.env` (pastikan ada titik di depan).
3. Edit file `.env` dan isi data database Anda.

### Langkah 4: Setup Pakasir (Payment Gateway)
1. Login ke [Pakasir.com](https://pakasir.com).
2. Salin **Project Slug** dan **API Key** ke file `.env`.
3. Isi **Webhook URL** di Pakasir dengan: `https://websitekamu.com/webhook.php`.

---

## Cara Menggunakan

### Login Admin
1. Buka halaman utama website dan klik tombol **Login** atau menu **Saya**.
2. Masukkan Username Default: `admin` dan Password Default: `admin123`.
3. Setelah login berhasil, buka menu **Profil (Saya)**.
4. Anda akan melihat menu khusus **Administrator** > **Dashboard Admin**.

### Reset Password Admin
Jika lupa password, kunjungi:
`https://websitekamu.com/reset.php?key=rahasia123`
Password akan kembali menjadi `admin123`.
**PENTING:** Segera hapus file `reset.php` setelah digunakan!

---
*Dibuat dengan PHP Native.*
