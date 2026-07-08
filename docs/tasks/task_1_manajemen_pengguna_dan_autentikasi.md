# Task 1: Manajemen Pengguna dan Autentikasi

## Deskripsi
Menyesuaikan sistem autentikasi dan manajemen pengguna (user management) yang sudah ada di Laravel agar selaras dengan PRD.md, khususnya terkait peran pengguna (user role).

## Tujuan
- Memastikan sistem dapat mengenali role pengguna sesuai PRD: Superadmin, Admin, Kades, Warga.
- Mendukung visualisasi data dengan ketersediaan data dummy untuk seluruh entitas.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Sesuaikan struktur tabel `users` (beserta tabel `roles` jika sistem existing menggunakannya) agar sesuai dengan desain ERD pada PRD. Pastikan field role terakomodasi dengan baik.
2. **Data Dummy (Seeder):** Buat atau perbarui data dummy untuk setiap role (Superadmin, Admin, Kades, Warga) menggunakan Seeder (misal: `UserSeeder`).
3. **Logika CRUD:** Sesuaikan logika Create, Read, Update, dan Delete (Controller & Model) pada modul user agar mengenali dan memproses role pengguna yang baru dengan benar.
4. **Konsistensi Kode:** Wajib mengikuti standar coding style, pola arsitektur, dan konvensi penamaan yang sudah ada (existing) pada modul user saat ini. Dilarang membuat pola baru yang tidak konsisten.
