# PTSP FLASH - Kantor Kementerian Agama Kota Surabaya

## Tentang Aplikasi
Aplikasi Pelayanan Terpadu Satu Pintu (PTSP) FLASH adalah sistem layanan digital terintegrasi untuk Kementerian Agama Kota Surabaya. Aplikasi ini memfasilitasi berbagai layanan kepegawaian dan umum secara online, memudahkan pegawai dan masyarakat dalam mengajukan permohonan dan memantau statusnya secara real-time.

**Filosofi FLASH:**
- **F**ast (Cepat)
- **L**oyal (Setia)
- **A**firmatif (Tegas/Positif)
- **S**imple (Sederhana)
- **H**umble (Rendah Hati)

> 📘 **Dokumentasi Lengkap:**
> Untuk panduan penggunaan aplikasi secara detail (alur kerja, hak akses, dan struktur sistem), silakan baca **[Dokumentasi Aplikasi (DOCUMENTATION.md)](DOCUMENTATION.md)**.

## Fitur Utama

### 1. Layanan Publik (Frontend)
- **Katalog Layanan**: Akses terpusat ke semua layanan, dikategorikan untuk kemudahan akses:
    - **Layanan Kepegawaian**: Cuti, Kenaikan Pangkat, Satya Lencana, dll.
    - **Layanan Bimas Islam**: ID Masjid/Musholla, Majelis Taklim, Layanan Nikah (Redirect Simkah).
    - **Layanan KUB**: Izin Pendirian Rumah Ibadah, Rekomendasi Rohaniawan Asing, Rekomendasi Tanah.
- **Pencarian Instan**: Temukan layanan dengan cepat menggunakan fitur pencarian real-time.
- **Formulir Cerdas**: Formulir pengajuan yang dinamis (upload berkas, validasi otomatis) berbasis Livewire.
- **Pelacakan Status**: Pantau progres permohonan kapan saja menggunakan **Kode Tracking**.
- **Responsive Design**: Tampilan yang optimal di Desktop maupun HP (Mobile).

### 2. Manajemen Admin (Backend)
- **Dashboard Modern**: Dibangun dengan FilamentPHP untuk pengelolaan data yang efisien.
- **Widget Statistik**: Grafik dan statistik yang disesuaikan dengan role (Global untuk Super Admin, Spesifik untuk Admin Layanan).
- **Log Aktivitas**: Audit trail lengkap untuk mencatat setiap tindakan user dan perubahan status permohonan.
- **Role-Based Access Control (RBAC)**:
  - **Super Admin**: Akses penuh ke seluruh sistem, manajemen user, dan log aktivitas.
  - **Admin Kepegawaian**: Mengelola layanan Cut, Pangkat, Satya Lencana, dll.
  - **Admin Bimas Islam**: Mengelola ID Masjid, Musholla, dan Majelis Taklim.
  - **Admin KUB**: Mengelola permohonan pendirian rumah ibadah dan rekomendasi KUB.
  - **Admin Zawa**: (Segera Hadir) Mengelola layanan Zakat dan Wakaf.
- **Verifikasi Berkas**: Kemudahan meninjau dokumen, menyetujui, atau menolak permohonan dengan catatan admin.
- **Notifikasi Email**: Pemohon otomatis menerima email saat status permohonan berubah.
- **Manajemen User**: Tambah, edit, dan atur hak akses pengguna.

## Teknologi
- **Core**: Laravel 12 (PHP 8.2+)
- **Admin Panel**: FilamentPHP v3
- **Frontend**: Livewire 3 + Alpine.js
- **Styling**: Tailwind CSS
- **Database**: MySQL
- **Permission**: Spatie Laravel Permission

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal (Localhost):

### 1. Persiapan Awal
Pastikan Computer Anda sudah terinstall:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### 2. Instalasi
```bash
# 1. Clone Repository (jika ada git) atau Extract folder
cd flash-ptsp

# 2. Install PHP Dependencies
composer install

# 3. Install JavaScript Dependencies & Build Assets
npm install && npm run build
```

### 3. Konfigurasi Database
1. Buat database baru di MySQL (misal: `ptsp_up`).
2. Salin file konfigurasi env:
   ```bash
   cp .env.example .env
   ```
3. Buka file `.env` dan sesuaikan koneksi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ptsp_up
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Generate App Key:
   ```bash
    php artisan key:generate
   ```

### 4. Konfigurasi Email (SMTP)
Agar notifikasi status permohonan dapat terkirim ke email pemohon, Anda **WAJIB** mengonfigurasi pengaturan SMTP di file `.env`. 

Gunakan layanan seperti **Gmail** (direkomendasikan menggunakan App Password) atau Mailtrap (untuk testing).

Contoh konfigurasi Gmail:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email_anda@gmail.com
MAIL_PASSWORD=app_password_anda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@kemenag-surabaya.go.id"
MAIL_FROM_NAME="PTSP Kemenag Surabaya"
```
> **Catatan:** Jika menggunakan Gmail, pastikan Anda menggunakan **App Password** (bukan password login biasa). [Lihat panduan membuat App Password Gmail](https://support.google.com/accounts/answer/185833).

### 5. Setup Database & User
Jalankan perintah berikut secara berurutan untuk menyiapkan tabel dan data awal:

```bash
# Migrasi Tabel
php artisan migrate

# Seed Data Layanan (Penting untuk Form)
php artisan db:seed --class=ServiceSeeder

# Setup Role & Permission
php artisan db:seed --class=RoleSeeder

# Buat Akun Super Admin Default
php artisan db:seed --class=AssignSuperAdminSeeder
```

### 5. Menjalankan Aplikasi
```bash
php artisan serve
```
Akses aplikasi di browser:
- **Frontend (Publik)**: `http://localhost:8000`
- **Backend (Admin)**: `http://localhost:8000/admin`

## Akun Default
Gunakan akun ini untuk login pertama kali ke halaman Admin:

- **Email**: `admin@admin.com`
- **Password**: `password` (atau sesuai konfigurasi User Factory Anda jika berbeda)
- **Role**: Super Admin
