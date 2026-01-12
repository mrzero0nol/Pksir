# Panduan Installasi Website Toko Produk Digital (PHP & cPanel)

Website ini adalah toko online produk digital (seperti akun premium, voucher, lisensi) yang terintegrasi dengan Payment Gateway **Pakasir** (QRIS).

## Fitur
- **Admin Panel**: Kelola Produk, Kategori, Stok, Voucher, dan Lihat Penjualan.
- **Sistem Stok Otomatis**: Pembeli langsung mendapatkan Email/Password setelah pembayaran sukses.
- **Integrasi Pakasir**: Pembayaran otomatis via QRIS.
- **Voucher Diskon**: Support potongan harga tetap atau persen.

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
4. Pastikan struktur file terlihat seperti ini di `public_html`:
   - `admin/`
   - `assets/`
   - `includes/`
   - `index.php`
   - `config.php`
   - `reset.php`
   - dll...

### Langkah 3: Konfigurasi
1. Di File Manager, cari file bernama `.env.example`.
2. Rename (ganti nama) file tersebut menjadi `.env` (pastikan ada titik di depan).
   *Jika file hilang setelah rename, klik "Settings" di pojok kanan atas File Manager dan centang "Show Hidden Files".*
3. Edit file `.env` dan isi sesuai data Anda:

```ini
DB_HOST=localhost
DB_NAME=namadomain_shop     <-- Nama Database dari Langkah 1
DB_USER=namadomain_user     <-- User Database dari Langkah 1
DB_PASS=password_anda       <-- Password Database

APP_URL=https://websitekamu.com
PAKASIR_API_KEY=xxxxx       <-- API Key dari Pakasir
PAKASIR_PROJECT_SLUG=xxxxx  <-- Project Slug dari Pakasir
```

### Langkah 4: Setup Pakasir (Payment Gateway)
1. Login ke [Pakasir.com](https://pakasir.com).
2. Buat Project baru.
3. Salin **Project Slug** dan **API Key** ke file `.env` tadi.
4. Di menu Edit Project Pakasir, isi **Webhook URL** dengan:
   `https://websitekamu.com/webhook.php`
   *(Ganti websitekamu.com dengan domain Anda)*.

---

## Cara Menggunakan

### Login Admin
- Buka: `https://websitekamu.com/admin/login.php`
- Username Default: `admin`
- Password Default: `admin123`

### Lupa Password / Reset Admin
Jika Anda lupa password admin atau gagal login pertama kali:
1. Buka browser dan kunjungi:
   `https://websitekamu.com/reset.php?key=rahasia123`
2. Jika konfigurasi database benar, Anda akan melihat pesan **SUKSES**. Password akan direset kembali menjadi `admin123`.
3. **PENTING:** Setelah berhasil login, segera **HAPUS** file `reset.php` dari File Manager cPanel agar website Anda aman dari peretas.

### Menambah Stok (Akun Premium/Voucher)
1. Masuk ke Admin Panel > **Produk**.
2. Klik tombol **Atur Stok** pada produk yang diinginkan.
3. Masukkan data akun (misal: `email:password`) di kolom input.
   - Anda bisa memasukkan banyak akun sekaligus (satu baris satu akun).
4. Klik **Simpan**.
   - Stok akan bertambah.
   - Ketika ada pembeli yang membayar, sistem akan otomatis mengambil satu baris stok dan memberikannya ke pembeli.

### Troubleshooting
- **Halaman Blank/Error 500**: Cek kembali konfigurasi di `.env` pastikan user/pass database benar.
- **Stok tidak muncul setelah bayar**: Pastikan Webhook URL di Pakasir sudah benar dan status transaksi di Pakasir sudah 'Success'.

---
*Dibuat dengan PHP Native agar mudah dikembangkan dan dideploy oleh pemula.*
