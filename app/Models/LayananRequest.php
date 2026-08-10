<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananRequest extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'nama_lengkap',
        'nip_nik',
        'jabatan',
        'pangkat_golongan',
        'perangkat_daerah',
        'no_wa',
        'file_lampiran',
        'data_tambahan',
        'status',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
