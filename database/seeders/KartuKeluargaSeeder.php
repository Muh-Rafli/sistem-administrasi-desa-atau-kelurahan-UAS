<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga;
use Illuminate\Database\Seeder;

class KartuKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'no_kk' => '3201021234560001',
                'alamat' => 'Jl. Merdeka No. 12',
                'rt' => '001',
                'rw' => '003',
                'desa_kelurahan' => 'Sukajaya',
                'kecamatan' => 'Cibinong',
                'kabupaten_kota' => 'Bogor',
                'provinsi' => 'Jawa Barat',
            ],
            [
                'no_kk' => '3201021234560002',
                'alamat' => 'Jl. Mawar Gg. Kelinci II',
                'rt' => '002',
                'rw' => '003',
                'desa_kelurahan' => 'Sukajaya',
                'kecamatan' => 'Cibinong',
                'kabupaten_kota' => 'Bogor',
                'provinsi' => 'Jawa Barat',
            ],
            [
                'no_kk' => '3201021234560003',
                'alamat' => 'Kampung Baru RT 03/RW 04',
                'rt' => '003',
                'rw' => '004',
                'desa_kelurahan' => 'Sukajaya',
                'kecamatan' => 'Cibinong',
                'kabupaten_kota' => 'Bogor',
                'provinsi' => 'Jawa Barat',
            ],
            [
                'no_kk' => '3201021234560004',
                'alamat' => 'Perum Griya Asri Blok B/14',
                'rt' => '004',
                'rw' => '005',
                'desa_kelurahan' => 'Sukamaju',
                'kecamatan' => 'Cilodong',
                'kabupaten_kota' => 'Depok',
                'provinsi' => 'Jawa Barat',
            ],
            [
                'no_kk' => '3201021234560005',
                'alamat' => 'Jl. Kenanga Raya No. 45',
                'rt' => '001',
                'rw' => '001',
                'desa_kelurahan' => 'Mekarsari',
                'kecamatan' => 'Cimanggis',
                'kabupaten_kota' => 'Depok',
                'provinsi' => 'Jawa Barat',
            ],
            [
                'no_kk' => '3173012345670001',
                'alamat' => 'Jl. Mangga Besar IV No. 12B',
                'rt' => '005',
                'rw' => '002',
                'desa_kelurahan' => 'Taman Sari',
                'kecamatan' => 'Taman Sari',
                'kabupaten_kota' => 'Jakarta Barat',
                'provinsi' => 'DKI Jakarta',
            ],
            [
                'no_kk' => '3173012345670002',
                'alamat' => 'Jl. Hayam Wuruk No. 100',
                'rt' => '001',
                'rw' => '002',
                'desa_kelurahan' => 'Taman Sari',
                'kecamatan' => 'Taman Sari',
                'kabupaten_kota' => 'Jakarta Barat',
                'provinsi' => 'DKI Jakarta',
            ],
            [
                'no_kk' => '3578012345670001',
                'alamat' => 'Jl. Dharmahusada Indah I/5',
                'rt' => '002',
                'rw' => '008',
                'desa_kelurahan' => 'Mulyorejo',
                'kecamatan' => 'Mulyorejo',
                'kabupaten_kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
            ],
            [
                'no_kk' => '3578012345670002',
                'alamat' => 'Kertajaya Indah Timur XI/12',
                'rt' => '003',
                'rw' => '008',
                'desa_kelurahan' => 'Mulyorejo',
                'kecamatan' => 'Mulyorejo',
                'kabupaten_kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
            ],
            [
                'no_kk' => '3374012345670001',
                'alamat' => 'Jl. Pandanaran No. 56',
                'rt' => '004',
                'rw' => '001',
                'desa_kelurahan' => 'Mugasari',
                'kecamatan' => 'Semarang Selatan',
                'kabupaten_kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
            ],
            [
                'no_kk' => '3374012345670002',
                'alamat' => 'Jl. Mugas Dalam II No. 3',
                'rt' => '001',
                'rw' => '001',
                'desa_kelurahan' => 'Mugasari',
                'kecamatan' => 'Semarang Selatan',
                'kabupaten_kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
            ],
            [
                'no_kk' => '5171012345670001',
                'alamat' => 'Jl. Teuku Umar No. 88',
                'rt' => '002',
                'rw' => '003',
                'desa_kelurahan' => 'Dauh Puri',
                'kecamatan' => 'Denpasar Barat',
                'kabupaten_kota' => 'Denpasar',
                'provinsi' => 'Bali',
            ],
            [
                'no_kk' => '5171012345670002',
                'alamat' => 'Jl. Diponegoro Gang VIII No. 4',
                'rt' => '003',
                'rw' => '003',
                'desa_kelurahan' => 'Dauh Puri',
                'kecamatan' => 'Denpasar Barat',
                'kabupaten_kota' => 'Denpasar',
                'provinsi' => 'Bali',
            ],
            [
                'no_kk' => '1271012345670001',
                'alamat' => 'Jl. Gajah Mada No. 101',
                'rt' => '001',
                'rw' => '002',
                'desa_kelurahan' => 'Petisah Tengah',
                'kecamatan' => 'Medan Petisah',
                'kabupaten_kota' => 'Medan',
                'provinsi' => 'Sumatera Utara',
            ],
            [
                'no_kk' => '1271012345670002',
                'alamat' => 'Jl. S. Parman No. 23',
                'rt' => '002',
                'rw' => '002',
                'desa_kelurahan' => 'Petisah Tengah',
                'kecamatan' => 'Medan Petisah',
                'kabupaten_kota' => 'Medan',
                'provinsi' => 'Sumatera Utara',
            ],
        ];

        foreach ($data as $kk) {
            KartuKeluarga::firstOrCreate(
                ['no_kk' => $kk['no_kk']],
                $kk
            );
        }
    }
}
