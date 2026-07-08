# Task 2: Manajemen Kartu Keluarga

## Deskripsi
Membuat fitur pengelolaan data Kartu Keluarga (KK) sebagai entitas parent dari data penduduk.

## Tujuan
- Admin dan pengguna berwenang dapat melakukan operasi CRUD pada data Kartu Keluarga.
- Mendukung visualisasi dan pengujian sistem melalui ketersediaan data contoh.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Buat file migration untuk tabel `kartu_keluarga` dengan field sesuai dengan rancangan pada PRD (no_kk, alamat, rt, rw, desa, dll).
2. **Data Dummy (Seeder):** Wajib membuat `KartuKeluargaSeeder` (atau factory) untuk men-generate data dummy KK minimal 10-20 record agar visualisasi data di halaman index dan tabel dapat terlihat baik.
3. **Logika CRUD:** Implementasi alur Model, View, dan Controller (MVC) untuk fitur Kartu Keluarga, dan pastikan tetap sejalan dengan coding style dari template/existing code.
