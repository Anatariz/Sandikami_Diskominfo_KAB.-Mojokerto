<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

$deskripsiHTML = <<<EOD
Layanan ini digunakan untuk mengajukan kegiatan sosialisasi, edukasi, bimbingan teknis, workshop, maupun penyuluhan mengenai keamanan informasi kepada perangkat daerah di lingkungan Pemerintah Kabupaten Mojokerto.<br><br>

<b>Syarat:</b>
<ul>
<li>Pengajuan dilakukan oleh perangkat daerah.</li>
<li>Mengisi formulir permohonan.</li>
<li>Menjelaskan kebutuhan kegiatan.</li>
<li>Mengusulkan waktu pelaksanaan.</li>
<li>Melampirkan surat permohonan apabila diperlukan.</li>
</ul>

<b>Output:</b>
<ul>
<li>Jadwal kegiatan Security Awareness.</li>
<li>Materi sosialisasi atau pelatihan.</li>
<li>Dokumentasi kegiatan.</li>
<li>Daftar hadir peserta (apabila diperlukan).</li>
</ul>
EOD;

$schema = [
    'pemohon' => [
        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah / Unit Kerja', 'type' => 'text', 'required' => true],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
        ['name' => 'no_wa', 'label' => 'Nomor WhatsApp', 'type' => 'text', 'required' => true],
    ],
    'layanan' => [
        ['name' => 'jenis_kegiatan', 'label' => 'Jenis Kegiatan', 'type' => 'select', 'required' => true, 'options' => ['Sosialisasi', 'Bimbingan Teknis (Bimtek)', 'Workshop', 'Seminar', 'Edukasi Keamanan Informasi', 'Lainnya']],
        ['name' => 'tema', 'label' => 'Tema yang Diinginkan', 'type' => 'text', 'required' => true],
        ['name' => 'jumlah_peserta', 'label' => 'Jumlah Peserta', 'type' => 'number', 'required' => true],
        ['name' => 'sasaran_peserta', 'label' => 'Sasaran Peserta', 'type' => 'select', 'required' => true, 'options' => ['ASN', 'Administrator Sistem', 'Operator Aplikasi', 'Perangkat Desa', 'Lainnya']],
        ['name' => 'tanggal_pelaksanaan', 'label' => 'Tanggal Pelaksanaan yang Diusulkan', 'type' => 'date', 'required' => true],
        ['name' => 'waktu_pelaksanaan', 'label' => 'Waktu Pelaksanaan', 'type' => 'time', 'required' => true],
        ['name' => 'lokasi_pelaksanaan', 'label' => 'Lokasi Pelaksanaan', 'type' => 'text', 'required' => true],
        ['name' => 'metode_pelaksanaan', 'label' => 'Metode Pelaksanaan', 'type' => 'select', 'required' => true, 'options' => ['Offline', 'Online', 'Hybrid']],
        ['name' => 'uraian_kebutuhan', 'label' => 'Uraian Singkat Kebutuhan Kegiatan', 'type' => 'textarea', 'required' => true],
    ]
];

$layanan = LayananKatalog::where('jenis_layanan', 'security-awareness')->first();

if ($layanan) {
    $layanan->deskripsi = $deskripsiHTML;
    $layanan->form_schema = $schema;
    $layanan->save();
    echo "Layanan Security Awareness berhasil diperbarui!\n";
} else {
    echo "Layanan tidak ditemukan.\n";
}
