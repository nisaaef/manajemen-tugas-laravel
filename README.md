# Manajemen Tugas Karyawan (Laravel)

Sistem admin berbasis web untuk mengelola data karyawan dan status penugasan mereka. Dibangun menggunakan **Laravel**, dengan dua level akses pengguna: **Admin** dan **Karyawan**.

## 📋 Deskripsi

Aplikasi ini membantu perusahaan memantau apakah setiap karyawan sudah ditugaskan atau belum untuk suatu pekerjaan/tugas tertentu. Admin memiliki kontrol penuh untuk mengelola data karyawan dan status penugasan, sementara karyawan dapat melihat informasi terkait tugas mereka sendiri.

## ✨ Fitur

- **Manajemen Data Karyawan** — tambah, lihat, ubah, dan hapus data karyawan.
- **Status Penugasan** — menandai apakah karyawan sudah ditugaskan atau belum untuk suatu tugas.
- **Role-Based Access Control**:
  - **Admin**: akses penuh — dapat melihat dan mengubah seluruh data, termasuk melakukan perubahan saat status penugasan diperbarui.
  - **Karyawan**: akses terbatas — dapat melihat data dan status penugasan yang relevan dengan dirinya.
- **Autentikasi Pengguna** — sistem login terpisah untuk Admin dan Karyawan.

## 🛠️ Tech Stack

- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Frontend**: Blade Templating, (tambahkan Tailwind/Bootstrap jika dipakai)

## 🚀 Instalasi & Menjalankan Secara Lokal

```bash
# Clone repository
git clone https://github.com/annisaaef24/manajemen-tugas-laravel.git
cd manajemen-tugas-laravel

# Install dependency PHP
composer install

# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Atur koneksi database di file .env, lalu jalankan migrasi
php artisan migrate

# (Opsional) isi data awal
php artisan db:seed

# Install dependency frontend (jika menggunakan Vite/NPM)
npm install
npm run dev

# Jalankan server lokal
php artisan serve
```

Aplikasi dapat diakses melalui `http://127.0.0.1:8000`.

## 👥 Role Pengguna

| Role      | Akses                                                             |
|-----------|--------------------------------------------------------------------|
| Admin     | Kelola seluruh data karyawan & status penugasan, dapat mengubah data kapan pun diperlukan |
| Karyawan  | Melihat data dan status penugasan miliknya sendiri                |

## 📸 Screenshot

_(Tambahkan screenshot tampilan dashboard Admin dan Karyawan di sini)_

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran
