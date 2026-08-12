<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Temporarily change IDs to high numbers to avoid unique constraint conflicts
DB::table('layanan_katalogs')->where('id', 4)->update(['id' => 40]); // CSIRT
DB::table('layanan_katalogs')->where('id', 5)->update(['id' => 50]); // Pentest
DB::table('layanan_katalogs')->where('id', 6)->update(['id' => 60]); // SSL

// Now assign the new IDs
// Pentest goes to 4
DB::table('layanan_katalogs')->where('id', 50)->update(['id' => 4]);
// SSL goes to 5
DB::table('layanan_katalogs')->where('id', 60)->update(['id' => 5]);
// CSIRT goes to 6
DB::table('layanan_katalogs')->where('id', 40)->update(['id' => 6]);

echo "Urutan berhasil diubah!\n";
