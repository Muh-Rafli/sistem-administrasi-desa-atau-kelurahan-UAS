<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'penduduk_id',
    'tipe_surat_id',
    'nomor_surat',
    'tanggal_pengajuan',
    'status',
    'keterangan_keperluan',
    'processed_by'
])]
class SuratKeterangan extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan';

    /**
     * Get the resident who requested the letter.
     */
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    /**
     * Get the type of the letter.
     */
    public function tipeSurat(): BelongsTo
    {
        return $this->belongsTo(TipeSurat::class, 'tipe_surat_id');
    }

    /**
     * Get the user who processed the letter.
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
