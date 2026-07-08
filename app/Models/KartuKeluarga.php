<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'no_kk',
    'alamat',
    'rt',
    'rw',
    'desa_kelurahan',
    'kecamatan',
    'kabupaten_kota',
    'provinsi'
])]
class KartuKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga';
}
