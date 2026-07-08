<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kks = KartuKeluarga::all();

        if ($kks->isEmpty()) {
            return;
        }

        $maleNames = [
            'Ahmad', 'Budi', 'Candra', 'Dedi', 'Eko', 'Fajar', 'Guntur', 'Hendra', 'Indra', 'Joko',
            'Kurniawan', 'Lukman', 'Mulyono', 'Nugroho', 'Oki', 'Prabowo', 'Rian', 'Setyawan', 'Taufik', 'Umar',
            'Wibowo', 'Yanto', 'Zainal', 'Rudi', 'Hadi', 'Slamet', 'Bambang', 'Supardi', 'Agus', 'Herman'
        ];

        $femaleNames = [
            'Ani', 'Bening', 'Citra', 'Dewi', 'Endah', 'Fitri', 'Gita', 'Hayati', 'Ika', 'Juita',
            'Kartika', 'Laras', 'Melati', 'Ningsih', 'Olla', 'Putri', 'Ratih', 'Sari', 'Tuti', 'Utami',
            'Wulan', 'Yanti', 'Zahra', 'Rina', 'Sri', 'Siti', 'Hartati', 'Rahayu', 'Amalia', 'Diana'
        ];

        $lastNames = [
            'Pratama', 'Wijaya', 'Saputra', 'Hidayat', 'Santoso', 'Kusuma', 'Siregar', 'Nasution', 'Lubis', 'Sinaga',
            'Simanjuntak', 'Setiawan', 'Gunawan', 'Sutrisno', 'Purnama', 'Wulandari', 'Rahmawati', 'Lestari', 'Sari', 'Indah'
        ];

        $places = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi', 'Bandung', 'Semarang', 'Surabaya', 'Denpasar', 'Medan'];
        $pendidikans = ['SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'Tidak Sekolah'];
        $pekerjaans = ['PNS', 'Karyawan Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Mahasiswa', 'Ibu Rumah Tangga', 'Belum Bekerja'];

        $nikCounter = 1000000000;

        foreach ($kks as $kk) {
            // 1. Kepala Keluarga (Suami)
            $firstName = $maleNames[array_rand($maleNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = $firstName . ' ' . $lastName;
            $birthYear = rand(1960, 1985);
            $birthDate = Carbon::create($birthYear, rand(1, 12), rand(1, 28))->toDateString();
            $nik = '320102' . str_pad($nikCounter++, 10, '0', STR_PAD_LEFT);

            Penduduk::create([
                'kk_id' => $kk->id,
                'nik' => $nik,
                'nama_lengkap' => $fullName,
                'tempat_lahir' => $places[array_rand($places)],
                'tanggal_lahir' => $birthDate,
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'pendidikan' => $pendidikans[array_rand($pendidikans)],
                'pekerjaan' => $pekerjaans[array_rand(array_slice($pekerjaans, 0, 5))],
                'status_perkawinan' => 'Kawin',
                'status_hidup' => true
            ]);

            // 2. Istri
            $wifeFirstName = $femaleNames[array_rand($femaleNames)];
            $wifeFullName = $wifeFirstName . ' ' . $lastName;
            $wifeBirthYear = $birthYear + rand(-5, 3);
            $wifeBirthDate = Carbon::create($wifeBirthYear, rand(1, 12), rand(1, 28))->toDateString();
            $wifeNik = '320102' . str_pad($nikCounter++, 10, '0', STR_PAD_LEFT);

            Penduduk::create([
                'kk_id' => $kk->id,
                'nik' => $wifeNik,
                'nama_lengkap' => $wifeFullName,
                'tempat_lahir' => $places[array_rand($places)],
                'tanggal_lahir' => $wifeBirthDate,
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'pendidikan' => $pendidikans[array_rand($pendidikans)],
                'pekerjaan' => rand(0, 1) ? 'Ibu Rumah Tangga' : $pekerjaans[array_rand(array_slice($pekerjaans, 0, 5))],
                'status_perkawinan' => 'Kawin',
                'status_hidup' => true
            ]);

            // 3. Anak-anak (1-3 anak)
            $numChildren = rand(1, 3);
            for ($i = 0; $i < $numChildren; $i++) {
                $gender = rand(0, 1) ? 'L' : 'P';
                $childFirstName = $gender === 'L' ? $maleNames[array_rand($maleNames)] : $femaleNames[array_rand($femaleNames)];
                $childFullName = $childFirstName . ' ' . $lastName;
                $childBirthYear = $birthYear + rand(20, 30);
                if ($childBirthYear > 2024) $childBirthYear = 2024;
                $childBirthDate = Carbon::create($childBirthYear, rand(1, 12), rand(1, 28))->toDateString();
                $childNik = '320102' . str_pad($nikCounter++, 10, '0', STR_PAD_LEFT);

                $age = 2026 - $childBirthYear;
                if ($age < 6) {
                    $pekerjaan = 'Belum Bekerja';
                    $pendidikan = 'Tidak Sekolah';
                } elseif ($age < 18) {
                    $pekerjaan = 'Belum Bekerja';
                    $pendidikan = $age < 12 ? 'SD' : ($age < 15 ? 'SMP' : 'SMA');
                } else {
                    $pekerjaan = rand(0, 1) ? 'Mahasiswa' : $pekerjaans[array_rand(array_slice($pekerjaans, 0, 5))];
                    $pendidikan = rand(0, 1) ? 'SMA' : 'S1';
                }

                Penduduk::create([
                    'kk_id' => $kk->id,
                    'nik' => $childNik,
                    'nama_lengkap' => $childFullName,
                    'tempat_lahir' => $places[array_rand($places)],
                    'tanggal_lahir' => $childBirthDate,
                    'jenis_kelamin' => $gender,
                    'agama' => 'Islam',
                    'pendidikan' => $pendidikan,
                    'pekerjaan' => $pekerjaan,
                    'status_perkawinan' => 'Belum Kawin',
                    'status_hidup' => true
                ]);
            }
        }
    }
}
