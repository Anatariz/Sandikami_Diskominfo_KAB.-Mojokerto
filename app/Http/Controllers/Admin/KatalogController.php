<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananKatalog;
use Illuminate\Support\Str;

class KatalogController extends Controller
{
    public function index()
    {
        $layanans = LayananKatalog::orderBy('created_at', 'desc')->get();
        return view('admin.katalog.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.katalog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:100',
            'form_schema' => 'required|json'
        ]);

        $slug = Str::slug($request->nama_layanan);
        
        // Ensure slug is unique
        if (LayananKatalog::where('jenis_layanan', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        LayananKatalog::create([
            'jenis_layanan' => $slug,
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'ikon' => $request->ikon ?? 'ri-file-list-3-line',
            'form_schema' => json_decode($request->form_schema, true),
            'status' => 'active'
        ]);

        return redirect()->route('admin.katalog.index')->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $layanan = LayananKatalog::findOrFail($id);
        return view('admin.katalog.edit', compact('layanan'));
    }

    public function update(Request $request, string $id)
    {
        $layanan = LayananKatalog::findOrFail($id);
        
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:100',
            'form_schema' => 'required|json'
        ]);

        $slug = Str::slug($request->nama_layanan);
        
        // Ensure slug is unique, excluding self
        if (LayananKatalog::where('jenis_layanan', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $slug . '-' . time();
        }

        $layanan->update([
            'jenis_layanan' => $slug,
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'ikon' => $request->ikon ?? 'ri-file-list-3-line',
            'form_schema' => json_decode($request->form_schema, true)
        ]);

        return redirect()->route('admin.katalog.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $layanan = LayananKatalog::findOrFail($id);
        $layanan->delete();
        return redirect()->route('admin.katalog.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
