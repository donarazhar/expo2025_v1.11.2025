# Al Azhar Expo 2025 - Landing Page & Registration System

Aplikasi Landing Page dan Sistem Registrasi Event **Al Azhar Expo 2025** yang dibangun dengan Laravel 12, Tailwind CSS, dan MySQL.

## 🎨 Design Specifications

- **Primary Color**: #0053C5 (Biru)
- **Secondary Color**: Putih
- **Style**: Elegan, Profesional & Modern
- **Layout**: Responsif untuk Desktop & Mobile
- **Theme**: Clean dengan border radius halus

## 📋 Fitur Utama

### Front Page (Single Scroll Landing Page)
1. **Header/Hero Section** - Menangkap perhatian pengunjung
2. **Why Join?** - Deskripsi singkat manfaat mengikuti event
3. **Jadwal & Lokasi** - Informasi penting event
4. **Formulir Pendaftaran** - Form registrasi peserta
5. **Footer** - Kontak dan media sosial

### Backend Dashboard
- CRUD Peserta
- Manajemen Absensi
- Manajemen E-Sertifikat
- QR Code Scanner
- Laporan dan Statistik

## 🗄️ Database Schema

### Tabel: PESERTA
| Field | Type | Constraint |
|-------|------|-----------|
| id_peserta | VARCHAR(50) | PRIMARY KEY |
| nama_lengkap | VARCHAR(255) | NOT NULL |
| email | VARCHAR(255) | UNIQUE, NOT NULL |
| no_hp | VARCHAR(20) | NOT NULL |
| asal_instansi | VARCHAR(255) | NOT NULL |
| tgl_registrasi | DATETIME | NOT NULL |
| qr_code_token | VARCHAR(100) | UNIQUE, INDEX |

**Format ID**: `AZE-YYYYMMDD-XXXXXX` (contoh: AZE-20250108-A1B2C3)

**QR Code Token**: UUID unik untuk setiap peserta

### Tabel: ABSENSI
| Field | Type | Constraint |
|-------|------|-----------|
| id_absensi | INT | PRIMARY KEY, AUTO_INCREMENT |
| qr_code_token | VARCHAR(100) | FOREIGN KEY → peserta.qr_code_token |
| waktu_scan | DATETIME | NOT NULL |
| petugas_scanner | VARCHAR(100) | NOT NULL |
| status_kehadiran | BOOLEAN | DEFAULT TRUE |

**Relasi**: 1 Peserta dapat memiliki banyak record absensi (untuk multi-day event)

### Tabel: E_SERTIFIKAT
| Field | Type | Constraint |
|-------|------|-----------|
| id_sertifikat | INT | PRIMARY KEY, AUTO_INCREMENT |
| qr_code_token | VARCHAR(100) | UNIQUE, FOREIGN KEY → peserta.qr_code_token |
| nomor_sertifikat | VARCHAR(100) | UNIQUE |
| tgl_penerbitan | DATETIME | NOT NULL |
| status_kirim | BOOLEAN | DEFAULT FALSE |

**Format Nomor**: `CERT-AZE-YYYY-XXXXX` (contoh: CERT-AZE-2025-00001)

**Relasi**: 1 Peserta hanya mendapat 1 sertifikat

## 📦 Instalasi

### 1. Clone/Extract Project
```bash
cd /path/to/webroot
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=al_azhar_expo
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
```bash
mysql -u root -p
```
```sql
CREATE DATABASE al_azhar_expo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 5. Jalankan Migration
```bash
php artisan migrate
```

Output yang diharapkan:
```
Migration table created successfully.
Migrating: 2025_01_01_000001_create_peserta_table
Migrated:  2025_01_01_000001_create_peserta_table (XX.XXms)
Migrating: 2025_01_01_000002_create_absensi_table
Migrated:  2025_01_01_000002_create_absensi_table (XX.XXms)
Migrating: 2025_01_01_000003_create_e_sertifikat_table
Migrated:  2025_01_01_000003_create_e_sertifikat_table (XX.XXms)
```

### 6. Seed Data (Opsional)
```bash
php artisan db:seed
```

### 7. Compile Assets
```bash
npm run dev
# atau untuk production
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 🔧 Troubleshooting Migration

### Error: Access Denied
```bash
# Pastikan kredensial database benar di .env
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Error: Database does not exist
```bash
# Buat database terlebih dahulu
mysql -u root -p -e "CREATE DATABASE al_azhar_expo;"
```

### Error: Syntax error or access violation
```bash
# Pastikan menggunakan MySQL 5.7+ atau MariaDB 10.2+
mysql --version
```

### Rollback Migration
```bash
# Rollback semua migration
php artisan migrate:rollback

# Rollback batch terakhir
php artisan migrate:rollback --step=1

# Reset semua migration
php artisan migrate:reset

# Fresh migration (drop all tables dan migrate ulang)
php artisan migrate:fresh
```

### Cek Status Migration
```bash
php artisan migrate:status
```

## 📊 Relasi Database

```
PESERTA (1) ──────< (M) ABSENSI
   │
   │ (1:1)
   │
   └──────────────> E_SERTIFIKAT
```

**Keterangan:**
- Satu peserta dapat memiliki banyak record absensi (untuk event multi-hari)
- Satu peserta hanya mendapat satu sertifikat
- QR Code Token adalah kunci penghubung antar tabel

## 🔐 Fitur Keamanan

- **Soft Deletes** pada tabel Peserta (data tidak benar-benar dihapus)
- **Unique Constraint** pada email dan QR code token
- **Foreign Key Cascade** untuk integritas data
- **Index** pada kolom yang sering di-query untuk performa optimal

## 📝 Model Eloquent

### Auto-Generate Fields
- `id_peserta`: Otomatis generate dengan format AZE-YYYYMMDD-XXXXXX
- `qr_code_token`: Otomatis generate UUID
- `tgl_registrasi`: Otomatis set ke waktu sekarang
- `nomor_sertifikat`: Otomatis generate dengan format CERT-AZE-YYYY-XXXXX

### Relasi Model

**Peserta Model:**
```php
$peserta->absensi; // Get all absensi records
$peserta->sertifikat; // Get sertifikat (one to one)
```

**Absensi Model:**
```php
$absensi->peserta; // Get peserta data
```

**ESertifikat Model:**
```php
$sertifikat->peserta; // Get peserta data
```

## 🚀 Next Steps

Setelah migration berhasil, langkah selanjutnya:
1. ✅ Membuat Controller untuk CRUD operations
2. ✅ Membuat Views untuk Landing Page
3. ✅ Membuat Backend Dashboard
4. ✅ Implementasi QR Code Generator & Scanner
5. ✅ Email Notification untuk sertifikat
6. ✅ Export data ke Excel/PDF

## 📧 Support

Untuk pertanyaan atau bantuan, silakan hubungi tim developer.

---

**© 2025 Al Azhar Expo - All Rights Reserved**