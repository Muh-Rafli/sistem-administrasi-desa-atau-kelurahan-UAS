<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'kode_surat',
    'nama_surat',
    'template_konten'
])]
class TipeSurat extends Model
{
    use HasFactory;

    protected $table = 'tipe_surat';
}
