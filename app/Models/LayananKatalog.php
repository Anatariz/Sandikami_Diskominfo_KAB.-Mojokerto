<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananKatalog extends Model
{
    protected $fillable = [
        'jenis_layanan',
        'nama_layanan',
        'deskripsi',
        'ikon',
        'form_schema',
        'status',
    ];

    protected $casts = [
        'form_schema' => 'array',
    ];
}
