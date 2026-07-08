<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'kk_id',
    'nik',
    'nama_lengkap',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'agama',
    'pendidikan',
    'pekerjaan',
    'status_perkawinan',
    'status_hidup'
])]
class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    /**
     * Get the family card that owns the resident.
     */
    public function kartuKeluarga(): BelongsTo
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }

    /**
     * Get the age of the resident.
     */
    public function getUmurAttribute(): int
    {
        return \Carbon\Carbon::parse($this->tanggal_lahir)->age;
    }
}
