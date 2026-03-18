# FCOM Company Profile

Draft awal website company profile berbasis PHP native dengan CMS/admin sederhana dan database MySQL.

## Struktur

- `public/` untuk halaman publik dan aset.
- `admin/` untuk login dan dashboard CMS.
- `app/` untuk bootstrap, config, dan helper.
- `database/` untuk schema dan seed MySQL.
- `views/` untuk template halaman.

## Setup Database

1. Buat database dan seed awal dengan import file [database/schema.sql](c:/Users/nadif/OneDrive/Desktop/Projek/FCOM/Company-profile/Fcom-Profile/database/schema.sql).
2. Sesuaikan kredensial MySQL di `app/config.php` jika host, user, password, atau nama database berbeda.
3. Jika database sudah terlanjur dibuat sebelumnya, jalankan migration [20260318_add_solutions_nav.sql](c:/Users/nadif/OneDrive/Desktop/Projek/FCOM/Company-profile/Fcom-Profile/database/migrations/20260318_add_solutions_nav.sql) agar fitur dropdown `Solutions` aktif.

## Jalankan

```bash
php -S localhost:8000 router.php
```

Lalu buka:

- `http://localhost:8000/`
- `http://localhost:8000/admin/login`

## Login Admin

- Username: `admin`
- Password: `fcom123`
