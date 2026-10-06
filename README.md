# 🛡️ Sandikami — Sistem Informasi Layanan Dinas Komunikasi dan Informatika Kab. Mojokerto

Aplikasi web berbasis **Laravel** untuk mengelola layanan, pengaduan, dan informasi Diskominfo Kabupaten Mojokerto.

---

## 📋 Prasyarat

Pastikan perangkat kamu sudah terinstal:

| Software | Versi Minimal |
|----------|--------------|
| PHP | 8.2+ |
| Composer | 2.x |
| MySQL / MariaDB | 8.0+ |
| Node.js & NPM | 18.x+ |
| Git | Terbaru |

---

## 🚀 Langkah-Langkah Menjalankan Website

### 1. Clone Repository

```bash
git clone https://github.com/Anatariz/Sandikami_Diskominfo_KAB.-Mojokerto.git
cd Sandikami_Diskominfo_KAB.-Mojokerto
```

---

### 2. Install Dependency PHP (Composer)

```bash
composer install
```

---

### 3. Salin File Environment

```bash
cp .env.example .env
```

> **Windows (Command Prompt):**
> ```cmd
> copy .env.example .env
> ```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sandikami
DB_USERNAME=root
DB_PASSWORD=
```

> Pastikan database dengan nama `sandikami` sudah dibuat terlebih dahulu di MySQL/MariaDB.
>
> ```sql
> CREATE DATABASE sandikami;
> ```

---

### 6. Jalankan Migrasi & Seeder Database

```bash
php artisan migrate --seed
```

> Perintah ini akan membuat semua tabel dan mengisi data awal (termasuk akun admin default).

---

### 7. Install Dependency Frontend (NPM)

```bash
npm install
```

---

### 8. Build Asset Frontend

Untuk **Development** (dengan hot-reload):

```bash
npm run dev
```

Untuk **Production** (build final):

```bash
npm run build
```

---

### 9. Jalankan Server Lokal

```bash
php artisan serve
```

Website akan berjalan di: **[http://localhost:8000](http://localhost:8000)**

---

### 10. (Opsional) Jalankan Queue Worker

Jika ada fitur antrian (queue), jalankan perintah berikut di terminal terpisah:

```bash
php artisan queue:work
```

---

## 🔑 Akun Terdaftar (Default)

Akun berikut dibuat secara otomatis saat menjalankan `php artisan migrate --seed`.

### 👑 Admin

| Field | Value |
|-------|-------|
| **Email** | `admin@mojokertokab.go.id` |
| **Password** | `admin123` |
| **Role** | Admin |
| **URL Login** | [http://localhost:8000/login](http://localhost:8000/login) |
| **Dashboard** | [http://localhost:8000/admin/dashboard](http://localhost:8000/admin/dashboard) |

> ⚠️ **Penting:** Segera ganti password admin setelah pertama kali login di lingkungan produksi!

---

### 👤 User (Masyarakat)

Akun user **tidak dibuat otomatis** melalui seeder. User dapat mendaftar secara mandiri melalui halaman registrasi.

| Field | Value |
|-------|-------|
| **URL Registrasi** | [http://localhost:8000/register](http://localhost:8000/register) |
| **URL Login** | [http://localhost:8000/login](http://localhost:8000/login) |

> Setelah registrasi, user mendapatkan role `user` secara otomatis dan dapat mengakses layanan serta fitur pengaduan.

---

## 🗂️ Struktur Akses

| Role | Halaman |
|------|---------|
| **Admin** | `/admin/dashboard` — Manajemen layanan, pengaduan, konten halaman |
| **User** | `/` — Halaman utama, layanan publik, pengaduan, profil |

---

## 🛠️ Perintah Artisan yang Sering Dipakai

```bash
# Reset database dan isi ulang seeder
php artisan migrate:fresh --seed

# Bersihkan cache aplikasi
php artisan optimize:clear

# Lihat semua route
php artisan route:list

# Jalankan queue worker
php artisan queue:work
```

---

## 📞 Kontak

**Dinas Komunikasi dan Informatika Kabupaten Mojokerto**
Website: [diskominfo.mojokertokab.go.id](https://diskominfo.mojokertokab.go.id)
