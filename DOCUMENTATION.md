# Dokumentasi Aplikasi PTSP FLASH

## Daftar Isi
1. [Pendahuluan](#pendahuluan)
2. [Arsitektur Sistem](#arsitektur-sistem)
3. [Panduan Pengguna (Frontend)](#panduan-pengguna-frontend)
4. [Panduan Administrator (Backend)](#panduan-administrator-backend)
5. [Daftar Layanan](#daftar-layanan)
6. [Manajemen Role & Akses](#manajemen-role--akses)
7. [Alur Kerja (Workflow)](#alur-kerja-workflow)

---

## Pendahuluan
Aplikasi PTSP FLASH Kementerian Agama Kota Surabaya dirancang untuk mendigitalkan proses pelayanan publik dan kepegawaian. Aplikasi ini memisahkan antarmuka untuk masyarakat/pegawai (Frontend) dan pengelola layanan (Backend/Admin Panel).

---

## Arsitektur Sistem
- **Frontend**: Menggunakan **Livewire** untuk interaktivitas tanpa reload halaman. Template menggunakan **Blade** dengan styling **Tailwind CSS**.
- **Backend**: Menggunakan **FilamentPHP** (v3) sebagai admin panel framework.
- **Database**: MySQL dengan skema relasional. Tabel utama meliputi `users`, `services`, `submissions`, `tracking_logs`, dan `activity_logs`.
- **Autentikasi**: Sistem login custom untuk admin (Filament) dan publik (jika dikembangkan lebih lanjut).
- **Email**: Menggunakan SMTP (Gmail) untuk notifikasi status.

---

## Panduan Pengguna (Frontend)

### 1. Mengakses Layanan
- Pengguna membuka halaman utama.
- Memilih kategori layanan (Kepegawaian, Bimas Islam, KUB, dll) atau menggunakan kolom pencarian.
- Klik layanan yang diinginkan untuk membuka formulir.

### 2. Mengisi Formulir
- Mengisi data diri (Nama, NIP/NIK, Jabatan/Unit Kerja).
- Mengunggah berkas persyaratan (Format: PDF/JPG, Maks: 2MB).
- **Note**: Beberapa form memiliki validasi khusus (misal: minimal 30 tanda tangan untuk Musholla).

### 3. Tracking Permohonan
- Setelah kirim, pengguna mendapat **Kode Tracking** dan **QR Code**.
- Simpan kode ini.
- Masukkan kode di fitur "Cari Layanan / Tracking" untuk melihat posisi berkas.
- Pengguna juga akan menerima update via Email.

---

## Panduan Administrator (Backend)

### 1. Login
- Akses `/portal` (custom path).
- Login menggunakan kredensial yang diberikan.

### 2. Dashboard
- **Super Admin**: Melihat statistik global (Total semua permohonan, grafik tren bulanan).
- **Admin Layanan**: Hanya melihat statistik layanan yang dikelolanya.

### 3. Memproses Permohonan
- Masuk ke menu layanan yang sesuai (misal: `Layanan Kepegawaian > Permohonan Cuti`).
- Klik icon **View (Mata)** untuk melihat detail dan validasi berkas.
- Klik icon **Ubah Status (Pensil)** pada tabel untuk melakukan aksi:
    - **Approve (Selesai)**: Jika syarat lengkap.
    - **Reject (Ditolak)**: Jika ada kekurangan, wajib menyertakan **Catatan Admin**.
    - **Process**: Jika sedang ditindaklanjuti.
- **Catatan Admin** akan terkirim ke email pemohon.

### 4. Log Aktivitas (Super Admin Only)
- Menu `User Management > Log Aktivitas Admin`.
- Memantau siapa melakukan apa: login, logout, create user, update status, delete user.
- Log bersifat Read-Only (tidak bisa dihapus/diedit) untuk keamanan audit.

---

## Daftar Layanan

### A. Layanan Bimas Islam
1. **ID Masjid/Musholla**: Permohonan nomor ID operasional.
2. **Majelis Taklim**: Pendaftaran majelis taklim baru.
3. **Perubahan Status Musholla**: Upgrade status musholla menjadi masjid.
4. **Layanan Nikah**: Redirect ke SIMKAH Gen 4.

### B. Layanan KUB (Kerukunan Umat Beragama)
1. **Izin Pendirian Rumah Ibadah**: Verifikasi persyaratan pendirian (SKB 2 Menteri).
2. **Rekomendasi Rohaniawan Asing**: Izin untuk penceramah/rohaniawan dari luar negeri.
3. **Rekomendasi Hak Atas Tanah**: Terkait status tanah wakaf/rumah ibadah.

### C. Layanan Kepegawaian
1. **Cuti**: Cuti tahunan, besar, sakit, melahirkan, dll.
2. **Kenaikan Pangkat**: Reguler, Pilihan.
3. **Satya Lencana**: Penghargaan 10, 20, 30 tahun.
4. **Izin Belajar / Tugas Belajar**.
5. **Karis / Karsu**: Kartu Istri / Suami.
6. **Pencantuman Gelar**.

---

## Manajemen Role & Akses

| Role | Akses Menu | Scope Data |
| :--- | :--- | :--- |
| **Super Admin** | Semua Menu (Bimas, KUB, Kepeg, User Mgmt, Logs) | Global (Semua Data) |
| **Admin Kepegawaian** | Hanya Layanan Kepegawaian | Hanya Data Kepegawaian |
| **Admin Bimas** | Hanya Layanan Bimas Islam | Hanya Data Bimas Islam |
| **Admin KUB** | Hanya Layanan KUB | Hanya Data KUB |
| **Admin Zawa** | Hanya Layanan Zawa (Coming Soon) | Hanya Data Zawa |

*Catatan: Admin Layanan tidak bisa melihat menu User Management atau Log Aktivitas.*

---

## Alur Kerja (Workflow)

1. **Submission**: User mengisi form -> Status `Pending` -> Email "Diterima" dikirim ke User.
2. **Verification**: Admin Cek Berkas -> Valid?
    - **Ya**: Ubah status ke `Approved` -> Email "Selesai" dikirim.
    - **Tidak**: Ubah status ke `Rejected` + Input Alasan -> Email "Ditolak" dikirim.
    - **Proses**: Jika butuh tanda tangan basah Kepala Kantor -> Ubah ke `Process`.
3. **Audit**: Setiap perubahan status dicatat di `ActivityLog` (Siapa, Kapan, Apa, IP Address).
