<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Helpers\CaptchaHelper;

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
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'persetujuan' => 'accepted',
            'captcha' => 'required|string',
            'captcha_hash' => 'required|string',
        ], [
            'persetujuan.accepted' => 'Anda harus menyetujui pemrosesan data untuk melanjutkan.',
            'captcha.required' => 'Kode captcha wajib diisi.',
        ]);

        if (!CaptchaHelper::verify($request->input('captcha'), $request->input('captcha_hash'))) {
            return back()->withInput()->withErrors([
                'captcha' => 'Kode captcha salah atau tidak sesuai. Silakan coba lagi.'
            ]);
        }

        $path = null;
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => auth()->id(),
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
