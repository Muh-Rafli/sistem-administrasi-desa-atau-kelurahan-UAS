<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get the residents for this family card.
     */
    public function penduduks(): HasMany
    {
        return $this->hasMany(Penduduk::class, 'kk_id');
    }
}
