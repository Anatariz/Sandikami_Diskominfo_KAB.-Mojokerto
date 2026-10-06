<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananKatalog extends Model
{
    protected $fillable = [
        'jenis_layanan',
        'nama_layanan',
        'kategori',
        'deskripsi',
        'ikon',
        'form_schema',
        'status',
    ];

    protected $casts = [
        'form_schema' => 'array',
    ];

    public function requests()
    {
        return $this->hasMany(LayananRequest::class, 'jenis_layanan', 'jenis_layanan');
    }
}
