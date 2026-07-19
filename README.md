# 🚗 Sistem Manajemen Rental Mobil

Aplikasi berbasis web untuk manajemen penyewaan mobil yang dikembangkan menggunakan Laravel. Proyek ini dibangun sebagai pemenuhan Tugas Akhir Semester (UAS) sekaligus portofolio pengembangan web full-stack, yang mengimplementasikan pemisahan hak akses (Role-Based Access Control) antara Administrator dan Pelanggan.

## ✨ Fitur Utama

### 👨‍💼 Fitur Administrator
* **Dashboard Analitik:** Menampilkan statistik total kendaraan, mobil tersedia, total transaksi, dan pelanggan aktif secara *real-time*.
* **Manajemen Inventaris Mobil:** Fitur CRUD (Create, Read, Update, Delete) lengkap dengan unggah foto kendaraan dan penentuan harga sewa.
* **Manajemen Transaksi:** Mengelola status pesanan pelanggan (Menunggu Konfirmasi -> Berjalan -> Selesai/Dibatalkan). Otomatis mengubah status ketersediaan mobil berdasarkan status transaksi.
* **Laporan PDF:** Fitur ekspor/cetak data inventaris mobil ke dalam format PDF menggunakan DomPDF.

### 👤 Fitur Pelanggan (User)
* **Katalog Responsif:** Menampilkan daftar mobil yang tersedia dengan visual grid yang modern.
* **Sistem Pemesanan (Booking):** Formulir penyewaan dengan kalender interaktif dan kalkulasi total harga otomatis berdasarkan durasi sewa.
* **Riwayat Transaksi:** Laporan visual untuk memantau status pesanan yang sedang berlangsung atau sudah selesai.
* **Manajemen Profil:** Pembaruan data diri lengkap dengan fitur unggah dan hapus foto profil (Avatar) interaktif.

## 🛠️ Teknologi yang Digunakan
* **Framework:** Laravel 11 (PHP)
* **Starter Kit / Auth:** Laravel Breeze (Blade)
* **Frontend:** Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Package Tambahan:** `barryvdh/laravel-dompdf` (Untuk Ekspor PDF)

## 🚀 Cara Instalasi & Menjalankan Proyek

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

1. **Clone repositori ini:**
   ```bash
   git clone [https://github.com/username-anda/repo-rental-mobil.git](https://github.com/username-anda/repo-rental-mobil.git)
   cd repo-rental-mobil