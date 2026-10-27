# 🌿 SIL-Absensi — Sistem Informasi Presensi Karyawan PT Sinkona Indonesia Lestari

<p align="center">
  <img src="https://github.com/user-attachments/assets/272b17a6-07cc-4403-9b71-b88a249138ed" alt="Dashboard SIL-Absensi PT Sinkona Indonesia Lestari" width="85%" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.18);" />
</p>

<p align="center">
  <strong>Sistem Informasi Presensi & Absensi Karyawan Berbasis Web dengan Validasi GPS Geofencing, Kamera Wajah, Dukungan Multi-Shift, dan Panel Admin Interaktif.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" /></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-8.2%20--%208.5+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.5" /></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="TailwindCSS" /></a>
  <a href="https://daisyui.com"><img src="https://img.shields.io/badge/daisyUI-5.x-5A0EF8?style=for-the-badge&logo=daisyui&logoColor=white" alt="daisyUI" /></a>
  <a href="https://www.mysql.com"><img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" /></a>
  <a href="https://leafletjs.com"><img src="https://img.shields.io/badge/Leaflet-1.9-199900?style=for-the-badge&logo=leaflet&logoColor=white" alt="LeafletJS" /></a>
</p>

---

## 📑 Daftar Isi

- [Tentang Aplikasi](#-tentang-aplikasi)
- [Pembaruan Terbaru](#-pembaruan-terbaru-v20)
- [Fitur Utama](#-fitur-utama)
  - [Dashboard & Karyawan](#-fitur-karyawan)
  - [Panel Administrator](#-fitur-administrator)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Panduan Instalasi](#-panduan-instalasi)
- [Akun Demo](#-akun-demo-default)
- [Tangkapan Layar](#-tangkapan-layar-screenshots)
- [Struktur Direktori](#-struktur-direktori-utama)
- [Lisensi](#-lisensi)

---

## 📌 Tentang Aplikasi

**SIL-Absensi** adalah platform presensi digital yang dirancang dan disesuaikan untuk kebutuhan operasional **PT Sinkona Indonesia Lestari**. Aplikasi ini mengotomatiskan pencatatan kehadiran karyawan dengan memanfaatkan:
1. **Deteksi Geolokasi (GPS)** untuk memastikan presensi dilakukan di area kantor yang sah (validasi radius/geofence).
2. **Kamera Selfie (Webcam/Smartphone)** untuk mencegah kecurangan dan memastikan keaslian kehadiran.
3. **Multi-Shift Jam Kerja** yang fleksibel untuk berbagai jadwal kerja karyawan (Non-Shift, Shift 1, Shift 2, Shift 3).
4. **Alur Persetujuan Administrasi** untuk pengelolaan pengajuan izin dan sakit secara transparan.

Aplikasi ini telah diperbarui secara penuh ke **Laravel 12** dan mendukung **PHP 8.5+**, dengan visual tema khas korporat PT Sinkona Indonesia Lestari (Emerald/Forest Green & Gold Amber) yang bersih, responsif, dan mendukung *Dark Mode*.

---

## ✨ Pembaruan Terbaru (v2.0)

- ⚡ **Kompatibilitas Penuh PHP 8.5 & Laravel 12**: Menggunakan standar driver PDO terbaru `\Pdo\Mysql::ATTR_SSL_CA` untuk performa dan keamanan optimal tanpa peringatan *deprecated*.
- 🎯 **Kartu Ringkasan Dashboard Interaktif**: Seluruh kartu metrik di dashboard admin (*Total Karyawan, Karyawan Hadir, Karyawan Sakit, Karyawan Izin, Karyawan Terlambat*) kini interaktif dan langsung mengarahkan admin ke halaman data terkait dalam sekali klik.
- ⏱️ **Kalkulasi & Filter Karyawan Terlambat**: Monitoring presensi kini memiliki filter khusus untuk menampilkan karyawan yang datang terlambat berdasarkan jam masuk masing-masing shift kerja.
- 🔔 **Sistem Notifikasi & Pesan Admin**: Fitur notifikasi otomatis saat pengajuan disetujui/ditolak serta menu kirim pesan personal dari admin ke karyawan.
- 🎨 **Peningkatan UI & Navigasi**: Animasi interaktif pada hover kartu, perbaikan tata letak tabel, dan pagination dinamis dengan `withQueryString()`.

---

## 🚀 Fitur Utama

### 👤 Fitur Karyawan

- **Presensi Masuk & Pulang**:
  - Deteksi titik koordinat GPS otomatis dengan validasi radius kantor.
  - Pengambilan foto langsung melalui kamera perangkat.
  - Input alasan keterlambatan jika masuk melebihi batas jam kerja shift.
- **Manajemen Shift Kerja**:
  - Jadwal jam kerja menyesuaikan shift penugasan (*Non-Shift, Shift 1, Shift 2, Shift 3*).
- **Pengajuan Izin & Sakit**:
  - Form pengajuan izin atau sakit mandiri lengkap dengan upload foto surat keterangan dokter/bukti pendukung.
  - Pelacakan status pengajuan (*Pending*, *Diterima*, *Ditolak*).
- **Riwayat Presensi Pribadi**:
  - Menampilkan histori kehadiran, jam masuk, jam pulang, dan titik lokasi pada bulan berjalan.
- **Pusat Notifikasi**:
  - Indikator lonceng notifikasi di navbar untuk membaca pengumuman atau hasil persetujuan pengajuan.

### 🛡️ Fitur Administrator

- **Interactive Summary Dashboard**:
  - Ringkasan cepat metrik harian dengan kartu klik-langsung ke halaman detail:
    - *Total Karyawan* &rarr; Halaman Manajemen Karyawan.
    - *Karyawan Hadir* &rarr; Monitoring Presensi Hari Ini.
    - *Karyawan Sakit* &rarr; Administrasi Presensi difilter status Sakit.
    - *Karyawan Izin* &rarr; Administrasi Presensi difilter status Izin.
    - *Karyawan Terlambat* &rarr; Monitoring Presensi difilter kehadiran terlambat.
- **Monitoring Presensi Real-Time**:
  - Pemantauan absensi masuk dan keluar hari ini secara langsung.
  - Modal peta interaktif (*Leaflet.js*) untuk memeriksa koordinat presensi karyawan.
- **Administrasi Izin & Sakit**:
  - Verifikasi berkas pengajuan izin/sakit karyawan dengan tombol *Terima* atau *Tolak*.
  - Mengirim notifikasi otomatis ke akun karyawan saat status berubah.
- **Kelola Data Master**:
  - Manajemen data karyawan (NIK, nama, departemen, jabatan, no. telepon, shift kerja).
  - Manajemen data departemen dan penugasan karyawan.
- **Konfigurasi Sistem**:
  - Pengaturan jam masuk & pulang per shift kerja.
  - Pengaturan titik koordinat kantor (latitude, longitude, dan radius toleransi jarak dalam meter).
- **Laporan Presensi & Cetak PDF**:
  - Ekspor laporan presensi per karyawan per bulan ke dokumen PDF.
  - Ekspor rekapitulasi kehadiran dan keterlambatan seluruh karyawan per bulan.

---

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi | Keterangan |
|---|---|---|
| **Backend** | [Laravel 12.x](https://laravel.com) | Framework PHP modern dan tangguh |
| **Bahasa** | PHP 8.2 — 8.5+ | Mendukung sintaks modern & driver PDO PHP 8.5 |
| **Frontend** | TailwindCSS 3.x & [daisyUI 5.x](https://daisyui.com) | Desain UI modern, responsif, dan mendukung Dark Mode |
| **Ikon** | [Remix Icon](https://remixicon.com) | Set ikon vektor modern |
| **Database** | MySQL 8.x / MariaDB | Relasional database dengan migrasi terstruktur |
| **Peta Digital** | [Leaflet.js](https://leafletjs.com) & OpenStreetMap | Visualisasi titik GPS lokasi absensi |
| **PDF Generator** | [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) | Render laporan presensi ke dokumen PDF |
| **Notifikasi** | Laravel Notification & SweetAlert2 | Pop-up interaktif & pesan sistem |

---

## 💻 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan proyek di lingkungan lokal:

### 1. Clone Repository
```bash
git clone https://github.com/WilyRadisya6/SIL-Absensi.git
cd SIL-Absensi
```

### 2. Install Dependensi (Composer & NPM)
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Buka file `.env` lalu sesuaikan konfigurasi koneksi database Anda:
```env
APP_NAME=SIL-Absensi
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_presensi
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key & Storage Link
```bash
php artisan key:generate
php artisan storage:link
```

### 5. Migrasi Database & Seeding Data Awal
```bash
php artisan migrate --seed
```

> **Catatan:** Perintah di atas akan membuat tabel database dan mengisikan data akun admin, lokasi kantor default, departemen, serta konfigurasi jam kerja shift.

### 6. Jalankan Server Aplikasi
Jalankan dev server frontend dan backend:

```bash
# Terminal 1: Vite Compiler
npm run dev

# Terminal 2: Laravel Development Server
php artisan serve
```

Buka peramban (browser) dan akses: **`http://127.0.0.1:8000`**

---

## 🔑 Akun Demo Default

Setelah menjalankan seeder database, Anda dapat login menggunakan akun berikut:

### 👑 Akun Administrator
- **URL Login**: `http://127.0.0.1:8000/login`
- **Email**: `admin@gmail.com`
- **Password**: `password`

### 👷 Akun Karyawan
- **URL Login**: `http://127.0.0.1:8000/login-karyawan`
- **NIK**: `12345` (atau `12346` / `12347`)
- **Password**: `password`

---

## 📸 Tangkapan Layar (Screenshots)

### 📊 Dashboard
| Dashboard Karyawan (Mobile-Friendly) | Dashboard Administrator (Interaktif) |
|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/a6f11269-960e-4c56-a95b-3d533e646f42" alt="Dashboard Karyawan" width="100%" /> | <img src="https://github.com/user-attachments/assets/272b17a6-07cc-4403-9b71-b88a249138ed" alt="Dashboard Admin" width="100%" /> |

### 📱 Presensi & Pengajuan
| Histori Presensi Karyawan | Formulir & Status Izin / Sakit |
|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/45309e13-8256-4615-96fb-45ccc4a6dde1" alt="Histori Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/d1dab88a-d7e7-4365-a786-b2bd2c9808fe" alt="Pengajuan Izin" width="100%" /> |

### 🖥️ Panel Administrasi
| Monitoring Presensi Real-Time & Peta | Laporan Presensi Cetak PDF | Persetujuan Izin & Sakit |
|:---:|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/0ced25cc-b33c-4e06-9f7a-2de1bd6764c8" alt="Monitoring Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/36f2fed3-29ba-4f89-9ecf-9a8b2f7a1eff" alt="Laporan Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/cd5b7067-6286-4254-a82a-fa67acfce39b" alt="Administrasi Izin" width="100%" /> |

---

## 📂 Struktur Direktori Utama

```
SIL-Absensi/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php      # Logika dashboard karyawan & admin
│   │   ├── JamKerjaController.php       # Manajemen jam shift kerja
│   │   ├── KaryawanController.php       # Manajemen karyawan & kirim pesan
│   │   ├── LokasiKantorController.php   # Manajemen titik GPS kantor
│   │   └── PresensiController.php       # Presensi, GPS, monitoring, izin & PDF
│   ├── Models/                          # Eloquent models
│   └── Notifications/                   # Notifikasi pesan admin ke karyawan
├── config/
│   └── database.php                     # Konfigurasi database (PHP 8.5 Pdo\Mysql)
├── database/
│   ├── migrations/                      # Skema migrasi database
│   └── seeders/                         # Seeder akun demo & master data
├── resources/
│   ├── css/                             # Konfigurasi TailwindCSS
│   ├── js/                              # Skrip Alpine.js & interaktivitas
│   └── views/
│       ├── admin/                       # Tampilan panel admin
│       ├── auth/                        # Tampilan login admin & karyawan
│       └── dashboard/                   # Tampilan portal presensi karyawan
└── routes/
    └── web.php                          # Rute aplikasi web
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).  
Hak Cipta &copy; 2026 **PT Sinkona Indonesia Lestari**. Seluruh hak dilindungi undang-undang.
