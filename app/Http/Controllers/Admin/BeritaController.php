<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = \App\Models\Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'status' => 'required|in:draft,published'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->judul) . '-' . time();
        $validated['ringkasan'] = \Illuminate\Support\Str::limit(strip_tags($request->isi), 150);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $validated['gambar'] = $path;
        }

        \App\Models\Berita::create($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $berita = \App\Models\Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, string $id)
    {
        $berita = \App\Models\Berita::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'status' => 'required|in:draft,published'
        ]);

        if ($request->judul !== $berita->judul) {
            $validated['slug'] = \Illuminate\Support\Str::slug($request->judul) . '-' . time();
        }
        $validated['ringkasan'] = \Illuminate\Support\Str::limit(strip_tags($request->isi), 150);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $validated['gambar'] = $path;
        }

        $berita->update($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $berita = \App\Models\Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
