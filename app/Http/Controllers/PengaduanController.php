<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'wa' => 'required|string|max:20',
            'kategori' => 'required|string',
            'pesan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'wa' => $request->wa,
            'kategori' => $request->kategori,
            'pesan' => $request->pesan,
            'lampiran' => $path
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim! Kami akan segera menindaklanjuti laporan Anda.');
    }
}
