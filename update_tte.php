<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

$deskripsiHTML = <<<EOD
Layanan ini digunakan untuk mengajukan penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE) pada aplikasi pemerintahan dan dokumen elektronik sesuai ketentuan yang berlaku.<br><br>

<b>Syarat:</b>
<ul>
<li>Pemohon merupakan ASN yang berwenang menggunakan Tanda Tangan Elektronik.</li>
<li>Memiliki e-mail resmi Pemerintah Kabupaten Mojokerto yang masih aktif.</li>
<li>Mengisi formulir permohonan secara lengkap.</li>
<li>Melampirkan surat permohonan dari perangkat daerah.</li>
<li>Nomor WhatsApp aktif untuk proses verifikasi.</li>
</ul>

<b>Output:</b>
<ul>
<li>Permohonan diteruskan untuk proses penerbitan Sertifikat Elektronik.</li>
<li>Informasi status permohonan.</li>
<li>Sertifikat Elektronik/TTE aktif setelah proses penerbitan selesai.</li>
</ul>
EOD;

$schema = [
    'pemohon' => [
        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
        ['name' => 'email_pemohon', 'label' => 'Email Pemohon', 'type' => 'email', 'required' => true],
        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
    ],
    'layanan' => [
        ['name' => 'jenis_pengajuan', 'label' => 'Jenis pengajuan', 'type' => 'select', 'required' => true, 'options' => ['Baru', 'Perpanjangan', 'Kendala TTE']],
        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
    ]
];

$tteLayanan = LayananKatalog::where('jenis_layanan', 'pengajuan-tanda-tangan-elektronik')
                            ->orWhere('jenis_layanan', 'tte')
                            ->first();

if ($tteLayanan) {
    $tteLayanan->deskripsi = $deskripsiHTML;
    $tteLayanan->form_schema = $schema;
    $tteLayanan->save();
    echo "Layanan TTE berhasil diperbarui!\n";
} else {
    echo "Layanan TTE tidak ditemukan.\n";
}
