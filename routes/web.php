<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengaduanController;

// Halaman Statis
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Profil
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/tentang', [PageController::class, 'profilTentang'])->name('tentang');
    Route::get('/tugas-fungsi', [PageController::class, 'profilTugasFungsi'])->name('tugas-fungsi');
    Route::get('/program-kerja', [PageController::class, 'profilProgramKerja'])->name('program-kerja');
});

// Panduan
Route::prefix('panduan')->name('panduan.')->group(function () {
    Route::get('/insiden', [PageController::class, 'panduanInsiden'])->name('insiden');
    Route::get('/sop', [PageController::class, 'panduanSop'])->name('sop');
    Route::get('/produk-hukum', [PageController::class, 'panduanProdukHukum'])->name('produk-hukum');
});

// Layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/layanan/{type}', [LayananController::class, 'form'])->name('layanan.form');
Route::post('/layanan/{type}/submit', [LayananController::class, 'submit'])->name('layanan.submit');

// Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
Route::post('/pengaduan/submit', [PengaduanController::class, 'submit'])->name('pengaduan.submit');
