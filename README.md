# 🌿 SIL-Absensi — Sistem Informasi Presensi Karyawan PT Sinkona Indonesia Lestari

<p align="center">
  <img src="https://github.com/user-attachments/assets/272b17a6-07cc-4403-9b71-b88a249138ed" alt="Dashboard SIL-Absensi" width="85%" style="border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);" />
</p>

<p align="center">
  <strong>Sistem Informasi Presensi & Absensi Karyawan Berbasis Web dengan Validasi GPS, Kamera Wajah, Multi-Shift, dan Panel Admin Terintegrasi.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/PHP-8.2%20--%208.5+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.5" />
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="TailwindCSS" />
  <img src="https://img.shields.io/badge/daisyUI-5.x-5A0EF8?style=for-the-badge&logo=daisyui&logoColor=white" alt="daisyUI" />
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</p>

---

## 📌 Tentang Aplikasi

**SIL-Absensi** adalah aplikasi presensi karyawan digital yang dikembangkan khusus untuk **PT Sinkona Indonesia Lestari**. Aplikasi ini memanfaatkan teknologi geolokasi (GPS) dan kamera untuk memastikan kehadiran karyawan tercatat akurat, transparan, dan sesuai dengan batasan radius kantor yang ditentukan.

Aplikasi ini telah diperbarui secara menyeluruh menggunakan **Laravel 12** dan mendukung **PHP 8.5+**, dengan antarmuka modern yang responsif, dukungan *Dark Mode*, dan navigasi kartu statistik interaktif.

---

## 🚀 Fitur Utama

### 👤 Karyawan (Mobile-Friendly Dashboard)
- **Presensi Masuk & Pulang**: Pengambilan foto selfie langsung via webcam/kamera smartphone serta deteksi koordinat GPS secara otomatis.
- **Validasi Geofencing (Radius Kantor)**: Presensi hanya dapat dilakukan jika karyawan berada dalam radius kantor yang telah ditentukan.
- **Keterangan Keterlambatan**: Karyawan dapat mengisi alasan apabila melakukan presensi masuk melewati batas jam kerja.
- **Dukungan Multi-Shift**: Jam masuk dan pulang menyesuaikan jadwal shift yang ditetapkan (*Non-Shift, Shift 1, Shift 2, Shift 3*).
- **Pengajuan Izin & Sakit**: Formulir pengajuan izin/sakit mandiri disertai unggah dokumen bukti (surat dokter/keterangan).
- **Riwayat & Rekap Presensi Bulanan**: Melihat daftar kehadiran, waktu presensi, foto, dan status kehadiran pribadi.
- **Notifikasi & Pesan Admin**: Menerima notifikasi langsung saat pengajuan izin/sakit disetujui/ditolak, serta pesan khusus dari admin.

### 🛡️ Admin Panel
- **Dashboard Ringkasan Interaktif**: Menampilkan data *real-time* hari ini: Total Karyawan, Hadir, Sakit, Izin, dan Terlambat. Kartu dan icon dapat diklik untuk langsung menuju halaman detail terkait.
- **Monitoring Presensi Real-Time**: Daftar absensi harian karyawan dilengkapi foto, jam masuk/keluar, dan selisih keterlambatan.
- **Peta Lokasi Interaktif (LeafletJS)**: Menampilkan visualisasi pin koordinat presensi masuk & keluar karyawan di atas peta digital.
- **Administrasi Izin & Sakit**: Memproses verifikasi persetujuan (*Approve*) atau penolakan (*Reject*) pengajuan izin dan sakit karyawan.
- **Kirim Pesan Karyawan**: Mengirim pesan personal atau teguran langsung ke dashboard notifikasi karyawan.
- **Kelola Data Karyawan & Departemen**: Manajemen data master karyawan, jabatan, departemen, serta penugasan shift kerja.
- **Konfigurasi Jam Kerja & Titik Kantor**: Pengaturan jam kerja per shift serta pengaturan koordinat latitude/longitude dan radius kantor.
- **Laporan Presensi & Cetak PDF**: Ekspor laporan absensi bulanan per karyawan maupun rekapitulasi seluruh karyawan ke format PDF (*DomPDF*).

---

## 🛠️ Tech Stack & Library

- **Backend Framework**: [Laravel 12](https://laravel.com/)
- **Bahasa Pemrograman**: PHP 8.2 — 8.5+ (Kompatibel dengan `Pdo\Mysql::ATTR_SSL_CA`)
- **Frontend & Styling**: TailwindCSS, [daisyUI](https://daisyui.com/), Remix Icon
- **Database**: MySQL / MariaDB
- **Peta Digital**: [Leaflet.js](https://leafletjs.com/) & OpenStreetMap
- **PDF Generator**: [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- **Autentikasi**: Multi-guard Authentication (Admin `web` & Karyawan `karyawan`)

---

## 💻 Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

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
Buat database baru di MySQL (misalnya `laravel_presensi`), lalu sesuaikan konfigurasi database pada `.env`:
```env
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

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Pengembangan
Buka 2 terminal atau jalankan secara bersamaan:

```bash
# Terminal 1: Vite Dev Server
npm run dev

# Terminal 2: Laravel Server
php artisan serve
```

Aplikasi dapat diakses melalui browser di: `http://127.0.0.1:8000`

---

## 📸 Tangkapan Layar (Screenshots)

### 📊 Dashboard
| Dashboard Karyawan | Dashboard Admin |
|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/a6f11269-960e-4c56-a95b-3d533e646f42" alt="Dashboard Karyawan" width="100%" /> | <img src="https://github.com/user-attachments/assets/272b17a6-07cc-4403-9b71-b88a249138ed" alt="Dashboard Admin" width="100%" /> |

### 📱 Presensi & Pengajuan Karyawan
| Histori Presensi Karyawan | Pengajuan Izin & Sakit |
|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/45309e13-8256-4615-96fb-45ccc4a6dde1" alt="Histori Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/d1dab88a-d7e7-4365-a786-b2bd2c9808fe" alt="Pengajuan Izin" width="100%" /> |

### 🖥️ Admin Panel
| Monitoring Presensi Real-Time | Laporan Presensi PDF | Administrasi Izin / Sakit |
|:---:|:---:|:---:|
| <img src="https://github.com/user-attachments/assets/0ced25cc-b33c-4e06-9f7a-2de1bd6764c8" alt="Monitoring Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/36f2fed3-29ba-4f89-9ecf-9a8b2f7a1eff" alt="Laporan Presensi" width="100%" /> | <img src="https://github.com/user-attachments/assets/cd5b7067-6286-4254-a82a-fa67acfce39b" alt="Administrasi Izin" width="100%" /> |

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi open-source [MIT License](LICENSE).
Dikembangkan untuk kebutuhan sistem presensi digital PT Sinkona Indonesia Lestari.
