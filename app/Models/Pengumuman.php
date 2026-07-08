<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'judul',
    'slug',
    'konten',
    'file_gambar',
    'tanggal_publish',
    'author_id'
])]
class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    /**
     * Get the user who wrote the announcement.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
