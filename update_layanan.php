<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tte = \App\Models\LayananKatalog::find(2);
$schema = $tte->form_schema;
$jenis_pengajuan = [
    'name' => 'jenis_pengajuan',
    'label' => 'Jenis Pengajuan',
    'type' => 'select',
    'options' => ['Baru', 'Perpanjangan', 'Kendala TTE'],
    'required' => true
];
array_unshift($schema['layanan'], $jenis_pengajuan);
$tte->form_schema = $schema;
$tte->save();
echo "Updated LayananKatalog!\n";
