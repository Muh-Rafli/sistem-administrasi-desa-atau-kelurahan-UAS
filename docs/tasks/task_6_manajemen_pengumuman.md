# Task 6: Manajemen Pengumuman

## Deskripsi
Membangun fitur portal mini/sistem CMS sederhana bagi pihak desa untuk menyebarkan informasi.

## Tujuan
- Admin atau Kepala Desa dapat mempublikasikan pengumuman untuk dapat diakses publik/warga.
- Mendukung visualisasi grid atau list berita di halaman portal.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Buat migration tabel `pengumuman` berelasi dengan `users` (author_id) seperti tertera di ERD.
2. **Data Dummy (Seeder):** Buat `PengumumanSeeder` yang menyertakan data paragraf dummy (Lorem Ipsum), judul yang relevan, serta tanggal publikasi acak agar halaman pengumuman dapat terlihat nyata saat di-load.
3. **Logika CRUD:** Fitur pengelolaan pengumuman lengkap dengan fitur upload gambar jika memungkinkan. Gunakan komponen UI yang selaras dengan NiceAdmin.
