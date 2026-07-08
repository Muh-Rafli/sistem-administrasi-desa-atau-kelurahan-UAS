# Task 4: Manajemen Tipe Surat

## Deskripsi
Menambahkan fitur master data tipe surat, yang berfungsi untuk menentukan jenis layanan administrasi persuratan yang disediakan.

## Tujuan
- Perangkat desa dapat dengan mudah mengelola template/kategori surat tanpa hardcode.
- Membantu penyusunan visualisasi dropdown/opsi saat pengajuan surat.

## Persyaratan (Requirements)
1. **Struktur Tabel:** Buat migration untuk tabel `tipe_surat` sesuai PRD (kode_surat, nama_surat, template_konten).
2. **Data Dummy (Seeder):** Buat `TipeSuratSeeder` untuk menyuntikkan data awal seperti SKD (Surat Keterangan Domisili), SKU (Surat Keterangan Usaha), dan SKTM (Surat Keterangan Tidak Mampu) ke dalam sistem untuk tes visualisasi.
3. **Logika CRUD:** Buat fitur untuk menambahkan, mengedit, dan menghapus tipe surat dengan mengikuti konvensi penamaan dan gaya bahasa pemrograman di repository.
