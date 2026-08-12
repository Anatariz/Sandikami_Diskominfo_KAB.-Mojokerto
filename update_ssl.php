<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

$deskripsiHTML = <<<EOD
Layanan ini digunakan untuk mengajukan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website atau aplikasi Pemerintah Kabupaten Mojokerto guna menjamin keamanan komunikasi data melalui protokol HTTPS.<br><br>

<b>Syarat:</b>
<ul>
<li>Domain atau subdomain merupakan milik Pemerintah Kabupaten Mojokerto.</li>
<li>Mengisi formulir permohonan secara lengkap.</li>
<li>Melampirkan surat permohonan.</li>
<li>Menyampaikan informasi alamat IP server dan lokasi hosting.</li>
<li>Pemohon merupakan pengelola website atau aplikasi.</li>
</ul>

<b>Output:</b>
<ul>
<li>Sertifikat SSL diterbitkan atau diperpanjang.</li>
<li>File sertifikat SSL.</li>
</ul>
EOD;

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
        ['name' => 'domain', 'label' => 'Nama Domain / Subdomain', 'type' => 'text', 'required' => true],
        ['name' => 'ip_address', 'label' => 'Alamat IP Server & Lokasi Hosting', 'type' => 'text', 'required' => true],
        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
    ]
];

$layanan = LayananKatalog::where('jenis_layanan', 'ssl')->first();

if ($layanan) {
    $layanan->deskripsi = $deskripsiHTML;
    $layanan->form_schema = $schema;
    $layanan->save();
    echo "Layanan SSL berhasil diperbarui!\n";
} else {
    echo "Layanan SSL tidak ditemukan.\n";
}
