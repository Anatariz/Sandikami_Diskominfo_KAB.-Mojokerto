<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengaduanController;

// Rute Publik (Auth)
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Publik (Tanpa Login)
Route::get('/', [PageController::class, 'index'])->name('home');
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

// Rute Terlindungi (Pengunjung harus login untuk pengajuan dan layanan)
Route::middleware('auth')->group(function () {
    // Layanan
    Route::get('/layanan/{type}', [LayananController::class, 'form'])->name('layanan.form');
    Route::post('/layanan/{type}/submit', [LayananController::class, 'submit'])->name('layanan.submit');

    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::post('/pengaduan/submit', [PengaduanController::class, 'submit'])->name('pengaduan.submit');

    // Profil Akun User
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Admin Dashboard
use App\Http\Controllers\Admin\AdminController;
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/layanan', [AdminController::class, 'indexLayanan'])->name('admin.layanan.index');
    Route::get('/admin/layanan/{id}', [AdminController::class, 'showLayanan'])->name('admin.layanan.show');
    Route::get('/admin/layanan/{id}/edit', [AdminController::class, 'editLayanan'])->name('admin.layanan.edit');
    Route::put('/admin/layanan/{id}', [AdminController::class, 'updateLayanan'])->name('admin.layanan.update');
    Route::delete('/admin/layanan/{id}', [AdminController::class, 'destroyLayanan'])->name('admin.layanan.destroy');

    Route::get('/admin/pengaduan', [AdminController::class, 'indexPengaduan'])->name('admin.pengaduan.index');
    Route::get('/admin/pengaduan/{id}', [AdminController::class, 'showPengaduan'])->name('admin.pengaduan.show');
    Route::get('/admin/pengaduan/{id}/edit', [AdminController::class, 'editPengaduan'])->name('admin.pengaduan.edit');
    Route::put('/admin/pengaduan/{id}', [AdminController::class, 'updatePengaduan'])->name('admin.pengaduan.update');
    Route::delete('/admin/pengaduan/{id}', [AdminController::class, 'destroyPengaduan'])->name('admin.pengaduan.destroy');

    // CMS Layanan Katalog
    Route::resource('admin/katalog', \App\Http\Controllers\Admin\KatalogController::class, ['as' => 'admin']);

    // CMS Profil (Tentang, Tugas Fungsi, Program Kerja)
    Route::resource('admin/profil', \App\Http\Controllers\Admin\ProfilController::class, ['as' => 'admin'])->only(['index', 'edit', 'update']);

    // CMS Panduan (Insiden, SOP, Produk Hukum)
    Route::resource('admin/panduan', \App\Http\Controllers\Admin\PanduanController::class, ['as' => 'admin'])->only(['index', 'edit', 'update']);
});


