<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

$schema = [
    'pemohon' => [
        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
    ],
    'layanan' => [
        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
    ]
];

$layanan = LayananKatalog::where('jenis_layanan', 'ssl')->first();

if ($layanan) {
    $layanan->form_schema = $schema;
    $layanan->save();
    echo "Layanan SSL berhasil diperbaiki (hanya surat permohonan)!\n";
} else {
    echo "Layanan SSL tidak ditemukan.\n";
}
