<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profilTentang()
    {
        return view('profil.tentang');
    }

    public function profilTugasFungsi()
    {
        return view('profil.tugas-fungsi');
    }

    public function profilProgramKerja()
    {
        return view('profil.program-kerja');
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
