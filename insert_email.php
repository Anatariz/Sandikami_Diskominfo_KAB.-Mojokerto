<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

$deskripsiHTML = <<<EOD
Layanan ini digunakan untuk mengajukan pembuatan akun surat elektronik (e-mail) resmi Pemerintah Kabupaten Mojokerto dengan domain @mojokertokab.go.id. E-mail resmi digunakan sebagai media komunikasi kedinasan antar instansi maupun dengan pihak eksternal secara aman dan profesional.<br><br>

<b>Syarat:</b>
<ul>
<li>Pemohon merupakan ASN, PPPK / pegawai yang berwenang di lingkungan Pemerintah Kabupaten Mojokerto.</li>
<li>Mengisi formulir permohonan secara lengkap.</li>
<li>Melampirkan surat permohonan yang telah ditandatangani oleh pejabat yang berwenang.</li>
<li>Nomor WhatsApp aktif untuk keperluan konfirmasi.</li>
<li>Belum memiliki akun e-mail resmi / pengajuan merupakan akun baru sesuai kebutuhan organisasi.</li>
</ul>

<b>Output:</b>
<ul>
<li>Akun e-mail resmi Pemerintah Kabupaten Mojokerto.</li>
<li>Informasi username akun.</li>
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
        ['name' => 'email_usulan', 'label' => 'Email yang diusulkan', 'type' => 'text', 'required' => true],
        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
    ]
];

$emailLayanan = LayananKatalog::updateOrCreate(
    ['jenis_layanan' => 'email'],
    [
        'nama_layanan' => 'Penerbitan E-Mail Pemda',
        'deskripsi' => $deskripsiHTML,
        'ikon' => 'ri-mail-send-line',
        'form_schema' => $schema,
        'status' => 'active',
    ]
);

echo "Layanan Email berhasil ditambahkan!\n";
