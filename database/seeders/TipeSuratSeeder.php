<?php

namespace Database\Seeders;

use App\Models\TipeSurat;
use Illuminate\Database\Seeder;

class TipeSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'kode_surat' => 'SKD',
                'nama_surat' => 'Surat Keterangan Domisili',
                'template_konten' => "Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:\n\nNama Lengkap: [nama_lengkap]\nNIK: [nik]\nTempat/Tgl Lahir: [tempat_lahir], [tanggal_lahir]\nJenis Kelamin: [jenis_kelamin]\nAgama: [agama]\nPendidikan: [pendidikan]\nPekerjaan: [pekerjaan]\nAlamat: [alamat]\n\nOrang tersebut di atas adalah benar-benar penduduk yang berdomisili di wilayah kami.",
            ],
            [
                'kode_surat' => 'SKU',
                'nama_surat' => 'Surat Keterangan Usaha',
                'template_konten' => "Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:\n\nNama Lengkap: [nama_lengkap]\nNIK: [nik]\nAlamat: [alamat]\n\nOrang tersebut di atas adalah benar-benar memiliki dan menjalankan kegiatan usaha di wilayah kami. Surat keterangan ini dibuat untuk keperluan pengajuan perizinan/kredit usaha.",
            ],
            [
                'override' => false,
                'kode_surat' => 'SKTM',
                'nama_surat' => 'Surat Keterangan Tidak Mampu',
                'template_konten' => "Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:\n\nNama Lengkap: [nama_lengkap]\nNIK: [nik]\nAlamat: [alamat]\n\nBerdasarkan data yang ada pada kami, keluarga yang bersangkutan tergolong dalam keluarga prasejahtera (tidak mampu) di wilayah kami. Surat keterangan ini dibuat untuk keperluan mendapatkan bantuan sosial/keringanan biaya pendidikan.",
            ],
            [
                'kode_surat' => 'SKCK',
                'nama_surat' => 'Surat Pengantar SKCK',
                'template_konten' => "Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:\n\nNama Lengkap: [nama_lengkap]\nNIK: [nik]\nAlamat: [alamat]\n\nOrang tersebut di atas berkelakuan baik, tidak sedang tersangkut perkara kriminal, dan tidak pernah terlibat dalam organisasi terlarang di wilayah kami. Surat pengantar ini dibuat untuk keperluan pengurusan SKCK di Kepolisian Sektor setempat.",
            ],
        ];

        foreach ($templates as $t) {
            TipeSurat::firstOrCreate(
                ['kode_surat' => $t['kode_surat']],
                [
                    'nama_surat' => $t['nama_surat'],
                    'template_konten' => $t['template_konten'],
                ]
            );
        }
    }
}
