<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $beritaTerbaru = \App\Models\Berita::where('status', 'published')->latest()->take(3)->get();
        $layanans = \App\Models\LayananKatalog::where('status', 'active')->take(3)->get();
        return view('home', compact('beritaTerbaru', 'layanans'));
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

    public function berita()
    {
        return view('berita');
    }

    public function panduanInsiden()
    {
        return view('panduan.insiden');
    }

    public function panduanSop()
    {
        return view('panduan.sop');
    }

    public function panduanProdukHukum()
    {
        return view('panduan.produk-hukum');
    }

    public function kontak()
    {
        return view('kontak');
    }
}
