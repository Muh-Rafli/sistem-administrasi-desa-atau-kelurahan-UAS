# Task 3: Manajemen Penduduk

## Deskripsi
Membangun fungsionalitas untuk mengelola data detail demografis penduduk yang terhubung ke entitas Kartu Keluarga.

## Tujuan
- Menyediakan interface untuk menambah, mengubah, melihat, dan menghapus data penduduk.
- Menyajikan visualisasi data yang lengkap bagi pengguna sistem.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Buat migration untuk tabel `penduduk` beserta definis relasinya (Foreign Key `kk_id`) ke tabel `kartu_keluarga`.
2. **Data Dummy (Seeder):** Buat `PendudukSeeder` yang menghasilkan banyak data dummy (misal 50+ record) dengan profil acak yang bervariasi (umur, jenis kelamin, pendidikan, pekerjaan) guna menguji ketahanan dan visualisasi tampilan tabel serta dashboard.
3. **Logika CRUD:** Implementasikan Controller, View, dan Model untuk entitas Penduduk. Jaga konsistensi code standard dengan arsitektur saat ini.
