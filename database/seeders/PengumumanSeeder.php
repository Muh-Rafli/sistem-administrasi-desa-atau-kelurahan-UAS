<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::whereIn('role', ['Superadmin', 'Admin', 'Kades'])->first();

        if (!$admin) {
            return;
        }

        $posts = [
            [
                'judul' => 'Kegiatan Kerja Bakti Massal Desa Sukajaya',
                'konten' => "Diberitahukan kepada seluruh warga Desa Sukajaya bahwa dalam rangka menyambut musim hujan dan mengantisipasi genangan air serta penyebaran penyakit, Pemerintah Desa akan mengadakan kegiatan Kerja Bakti Massal.\n\nKegiatan ini akan dilaksanakan pada:\nHari/Tanggal: Minggu, 12 Juli 2026\nWaktu: Pukul 07.00 WIB s.d Selesai\nLokasi: Seluruh lingkungan RT/RW masing-masing\n\nDiharapkan kepada seluruh ketua RT/RW untuk dapat mengoordinasikan warganya serta membawa peralatan kerja bakti masing-masing. Mari kita jaga kebersihan dan kesehatan lingkungan desa kita tercinta.",
                'tanggal_publish' => now()->subDays(2)->toDateString(),
            ],
            [
                'judul' => 'Penyaluran Bantuan Langsung Tunai (BLT) Bulan Juli 2026',
                'konten' => "Pemerintah Desa Sukajaya mengumumkan jadwal penyaluran Bantuan Langsung Tunai Dana Desa (BLT-DD) untuk periode bulan Juli 2026.\n\nPenyaluran akan dilaksanakan pada:\nHari/Tanggal: Rabu, 15 Juli 2026\nWaktu: Pukul 09.00 - 13.00 WIB\nTempat: Aula Kantor Desa Sukajaya\n\nPersyaratan pengambilan:\n1. Membawa KTP Asli dan fotokopi\n2. Membawa Kartu Keluarga (KK) Asli\n3. Membawa surat undangan penerima BLT\n\nBagi warga penerima manfaat yang berhalangan hadir secara langsung (karena sakit/usia lanjut) harap memberikan surat kuasa bermaterai kepada anggota keluarga yang mewakili dalam satu KK.",
                'tanggal_publish' => now()->subDays(1)->toDateString(),
            ],
            [
                'judul' => 'Pemberitahuan Imunisasi Balita Posyandu Melati',
                'konten' => "Posyandu Melati Desa Sukajaya akan menyelenggarakan kegiatan imunisasi rutin bulanan untuk bayi dan balita guna memantau tumbuh kembang anak serta memberikan kekebalan terhadap berbagai penyakit menular.\n\nKegiatan akan dilaksanakan pada:\nHari/Tanggal: Jumat, 17 Juli 2026\nWaktu: Pukul 08.00 s.d 11.00 WIB\nTempat: Posko Posyandu Melati (RT 02/RW 03)\n\nLayanan yang disediakan:\n- Penimbangan berat badan dan pengukuran tinggi badan\n- Pemberian makanan tambahan (PMT) bergizi\n- Imunisasi dasar lengkap (BCG, DPT, Polio, Campak)\n- Konsultasi kesehatan anak gratis\n\nHarap membawa Buku KIA (Kesehatan Ibu dan Anak) masing-masing saat datang ke lokasi.",
                'tanggal_publish' => now()->toDateString(),
            ],
            [
                'judul' => 'Sosialisasi Pencegahan Demam Berdarah Dengue (DBD) dengan 3M Plus',
                'konten' => "Sehubungan dengan meningkatnya curah hujan dalam beberapa pekan terakhir, Pemerintah Desa Sukajaya bekerja sama dengan Puskesmas setempat mengimbau seluruh warga untuk meningkatkan kewaspadaan terhadap penularan Demam Berdarah Dengue (DBD).\n\nKami sangat menyarankan seluruh warga untuk mempraktikkan gerakan 3M Plus di rumah masing-masing:\n1. Menguras tempat penampungan air secara rutin\n2. Menutup rapat semua tempat penyimpanan air\n3. Mendaur ulang barang bekas yang berpotensi menampung air hujan\n\nPlus: Menggunakan kelambu, memasang obat nyamuk, menyebarkan bubuk larvasida (abate) di bak mandi, serta memelihara tanaman pengusir nyamuk. Bubuk abate dapat diperoleh secara gratis di Kantor Desa atau kader Posyandu terdekat.",
                'tanggal_publish' => now()->subDays(5)->toDateString(),
            ],
            [
                'judul' => 'Pelatihan Kewirausahaan UMKM Desa Sukajaya',
                'konten' => "Guna mendorong kemandirian ekonomi warga dan meningkatkan kelas usaha mikro, kecil, dan menengah (UMKM) di Desa Sukajaya, Pemerintah Desa menyelenggarakan Pelatihan Peningkatan Keterampilan Usaha.\n\nDetail Pelatihan:\nHari/Tanggal: Sabtu s.d Minggu, 25-26 Juli 2026\nTempat: Balai Pelatihan Masyarakat Desa\nMateri: Strategi Pemasaran Digital, Pembukuan Keuangan Sederhana, dan Teknik Pengemasan Produk Kreatif\n\nPendaftaran dibuka gratis untuk seluruh warga pelaku usaha lokal. Kuota terbatas hanya untuk 30 peserta demi menjaga keefektifan pelatihan. Silakan mendaftar ke Kantor Desa pada hari kerja paling lambat tanggal 20 Juli 2026.",
                'tanggal_publish' => now()->subDays(10)->toDateString(),
            ],
        ];

        foreach ($posts as $post) {
            Pengumuman::firstOrCreate(
                ['slug' => Str::slug($post['judul'])],
                [
                    'judul' => $post['judul'],
                    'konten' => $post['konten'],
                    'file_gambar' => null,
                    'tanggal_publish' => $post['tanggal_publish'],
                    'author_id' => $admin->id,
                ]
            );
        }
    }
}
