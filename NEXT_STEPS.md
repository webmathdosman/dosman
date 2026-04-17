# Next Steps - School Management System

Catatan lanjutan ini disiapkan agar development bisa dilanjutkan dari PC lain.

## 1) Setup Environment (Prioritas)

- Pastikan versi PHP kompatibel dengan Laravel project.
- Pastikan Composer terpasang.
- Pastikan Node.js + npm tersedia (untuk build Vite/Tailwind).
- Copy project ini ke PC baru, lalu jalankan:
  - `composer install`
  - `npm install`

## 2) Konfigurasi Database

Disarankan gunakan MySQL/MariaDB sesuai requirement project.

Update `.env`:

- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=school_management_system`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`

Lalu jalankan:

- `php artisan key:generate`
- `php artisan migrate --seed`

## 3) Build Frontend

- Development: `npm run dev`
- Production build: `npm run build`

## 4) Verifikasi Fitur yang Sudah Dibuat

### Modul Rapor
- CRUD data rapor.
- Filter (siswa, mapel, semester, tahun ajaran).
- Export PDF rapor (`/reports-export-pdf`).

### Modul Absensi
- CRUD data absensi.
- Filter (siswa, status, tanggal).

### Modul Pelanggaran
- CRUD data pelanggaran.
- Filter (siswa, tanggal).

### Modul Prestasi
- CRUD data prestasi.
- Filter (siswa, tanggal).

### Summary Poin Siswa
- Halaman summary poin per siswa (net = prestasi - pelanggaran).

## 5) Akun Seeder (Demo)

Setelah `migrate --seed`, akun demo:

- Super Admin: `admin@school.test`
- Guru: `guru@school.test`
- Siswa: `siswa@school.test`
- Password default: `password`

## 6) Hal yang Perlu Dikerjakan Berikutnya

- Tambahkan policy/gate per resource (authorization lebih ketat).
- Tambahkan tampilan error validasi per field di semua form.
- Tambahkan pagination untuk list data.
- Tambahkan test:
  - Feature test auth + role access.
  - Unit test service layer (`ReportService`, `AttendanceService`, `DisciplineService`).
- Finalisasi format PDF rapor sesuai template sekolah.
- Finalisasi workflow absensi lanjutan (location-based / face-based) jika diperlukan.
- Lanjutkan modul CBT (stabilitas sesi + autosave + anti refresh accidental).

## 7) Deploy Notes (aaPanel/Linux)

- Pastikan writable permissions:
  - `storage`
  - `bootstrap/cache`
- Jalankan deploy script:
  - `deployment.sh`
- Jalankan cache command di server:
  - `php artisan optimize:clear`
  - `php artisan config:cache`
  - `php artisan route:cache`
  - `php artisan view:cache`

## 8) Quick Resume Checklist

- [ ] `composer install` sukses
- [ ] `npm install` sukses
- [ ] `.env` database valid
- [ ] `php artisan migrate --seed` sukses
- [ ] `npm run build` sukses
- [ ] CRUD + filter + export PDF + summary poin teruji
- [ ] Siap lanjut fase berikutnya
