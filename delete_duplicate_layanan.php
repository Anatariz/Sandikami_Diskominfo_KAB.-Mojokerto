<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LayananKatalog;

// Fetch the duplicate one which is higher up (lower ID)
$layanan = LayananKatalog::find(3);

if ($layanan && $layanan->nama_layanan === 'Pengujian Keamanan Aplikasi') {
    $layanan->delete();
    echo "Layanan dengan ID 3 (Pengujian Keamanan Aplikasi) berhasil dihapus!\n";
} else {
    echo "Layanan tidak ditemukan atau namanya tidak sesuai.\n";
}
