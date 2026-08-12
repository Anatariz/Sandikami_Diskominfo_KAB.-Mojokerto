<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $layanans = \App\Models\LayananKatalog::where('status', 'active')->take(3)->get();
        
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->take(3)->get();
        
        $panduans = \App\Models\PageContent::where('slug', 'like', 'panduan-%')->take(3)->get();
        
        $stats = [
            'tte' => \App\Models\LayananRequest::where('jenis_layanan', 'tte')->count(),
            'email' => \App\Models\LayananRequest::where('jenis_layanan', 'email')->count(),
            'assessment' => \App\Models\LayananRequest::whereIn('jenis_layanan', ['assessment', 'pentest'])->count(),
            'insiden' => \App\Models\Pengaduan::count(),
        ];
        
        return view('home', compact('layanans', 'beritas', 'panduans', 'stats'));
    }

    public function profilTentang()
    {
        $content = \App\Models\PageContent::where('slug', 'tentang-sandikami')->first();
        return view('profil.tentang', compact('content'));
    }

    public function profilTugasFungsi()
    {
        $content = \App\Models\PageContent::where('slug', 'tugas-fungsi')->first();
        return view('profil.tugas-fungsi', compact('content'));
    }

    public function profilProgramKerja()
    {
        $content = \App\Models\PageContent::where('slug', 'program-kerja')->first();
        return view('profil.program-kerja', compact('content'));
    }

    public function beritaIndex()
    {
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->paginate(9);
        return view('berita.index', compact('beritas'));
    }

    public function beritaShow($slug)
    {
        $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }

    public function panduanInsiden()
    {
        $content = \App\Models\PageContent::where('slug', 'panduan-insiden')->first();
        return view('panduan.insiden', compact('content'));
    }

    public function panduanSop()
    {
        $content = \App\Models\PageContent::where('slug', 'panduan-sop')->first();
        return view('panduan.sop', compact('content'));
    }

    public function panduanProdukHukum()
    {
        $content = \App\Models\PageContent::where('slug', 'panduan-produk-hukum')->first();
        return view('panduan.produk-hukum', compact('content'));
    }

    public function kontak()
    {
        return view('kontak');
    }
}
