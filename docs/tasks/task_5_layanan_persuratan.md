# Task 5: Layanan Persuratan

## Deskripsi
Membangun inti sistem layanan publik, yaitu pengajuan dan pencatatan histori pembuatan surat keterangan untuk warga.

## Tujuan
- Mencatat seluruh alur pengajuan surat dari permohonan hingga selesai.
- Dapat menampilkan visualisasi data surat yang pending, diproses, dan selesai.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Buat migration tabel `surat_keterangan` dengan relasi yang tepat ke tabel `penduduk`, `tipe_surat`, dan tabel `users` (sebagai pemroses).
2. **Data Dummy (Seeder):** Buat `SuratKeteranganSeeder` dengan status bervariasi (contoh: 5 Pending, 5 Diproses, 10 Selesai, 2 Ditolak). Ini penting untuk melihat visualisasi status berupa badge/label pada antarmuka admin.
3. **Logika Bisnis:** Implementasikan antarmuka dan proses backend untuk pengajuan dan persetujuan surat sesuai pola standar yang sudah diterapkan pada aplikasi.
