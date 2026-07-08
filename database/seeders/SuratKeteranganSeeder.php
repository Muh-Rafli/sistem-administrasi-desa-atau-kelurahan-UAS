<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\TipeSurat;
use App\Models\User;
use App\Models\SuratKeterangan;
use Illuminate\Database\Seeder;

class SuratKeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penduduks = Penduduk::all();
        $tipeSurats = TipeSurat::all();
        $admin = User::whereIn('role', ['Superadmin', 'Admin'])->first();

        if ($penduduks->isEmpty() || $tipeSurats->isEmpty()) {
            return;
        }

        $keperluans = [
            'Melengkapi persyaratan pendaftaran sekolah',
            'Pengajuan beasiswa kuliah di perguruan tinggi',
            'Melamar pekerjaan di perusahaan swasta',
            'Pencairan dana bantuan sosial pemerintah',
            'Persyaratan pengajuan kredit pemilikan rumah (KPR)',
            'Syarat pembuatan kartu tanda penduduk (KTP)',
            'Klarifikasi alamat domisili untuk pembukaan rekening bank',
            'Pembuatan surat kelakuan baik di polsek setempat'
        ];

        // 1. Seed 5 Pending
        for ($i = 0; $i < 5; $i++) {
            $penduduk = $penduduks->random();
            $tipeSurat = $tipeSurats->random();
            SuratKeterangan::create([
                'penduduk_id' => $penduduk->id,
                'tipe_surat_id' => $tipeSurat->id,
                'nomor_surat' => null,
                'tanggal_pengajuan' => now()->subDays(rand(1, 5))->toDateString(),
                'status' => 'Pending',
                'keterangan_keperluan' => $keperluans[array_rand($keperluans)],
                'processed_by' => null,
            ]);
        }

        // 2. Seed 5 Diproses
        for ($i = 0; $i < 5; $i++) {
            $penduduk = $penduduks->random();
            $tipeSurat = $tipeSurats->random();
            SuratKeterangan::create([
                'penduduk_id' => $penduduk->id,
                'tipe_surat_id' => $tipeSurat->id,
                'nomor_surat' => 'Draft/' . $tipeSurat->kode_surat . '/' . rand(100, 999),
                'tanggal_pengajuan' => now()->subDays(rand(6, 10))->toDateString(),
                'status' => 'Diproses',
                'keterangan_keperluan' => $keperluans[array_rand($keperluans)],
                'processed_by' => $admin ? $admin->id : null,
            ]);
        }

        // 3. Seed 10 Selesai
        for ($i = 0; $i < 10; $i++) {
            $penduduk = $penduduks->random();
            $tipeSurat = $tipeSurats->random();
            SuratKeterangan::create([
                'penduduk_id' => $penduduk->id,
                'tipe_surat_id' => $tipeSurat->id,
                'nomor_surat' => '470/' . str_pad(rand(1, 150), 3, '0', STR_PAD_LEFT) . '/SK/' . $tipeSurat->kode_surat . '/' . now()->year,
                'tanggal_pengajuan' => now()->subDays(rand(11, 30))->toDateString(),
                'status' => 'Selesai',
                'keterangan_keperluan' => $keperluans[array_rand($keperluans)],
                'processed_by' => $admin ? $admin->id : null,
            ]);
        }

        // 4. Seed 2 Ditolak
        for ($i = 0; $i < 2; $i++) {
            $penduduk = $penduduks->random();
            $tipeSurat = $tipeSurats->random();
            SuratKeterangan::create([
                'penduduk_id' => $penduduk->id,
                'tipe_surat_id' => $tipeSurat->id,
                'nomor_surat' => null,
                'tanggal_pengajuan' => now()->subDays(rand(2, 4))->toDateString(),
                'status' => 'Ditolak',
                'keterangan_keperluan' => $keperluans[array_rand($keperluans)] . ' (Ditolak karena berkas kurang lengkap)',
                'processed_by' => $admin ? $admin->id : null,
            ]);
        }
    }
}
