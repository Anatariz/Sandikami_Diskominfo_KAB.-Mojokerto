<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $pages = \App\Models\PageContent::all();
        return view('admin.profil.index', compact('pages'));
    }

    public function edit(string $id)
    {
        $page = \App\Models\PageContent::findOrFail($id);
        return view('admin.profil.edit', compact('page'));
    }

    public function update(Request $request, string $id)
    {
        $page = \App\Models\PageContent::findOrFail($id);
        
        $validated = $request->validate([
            'content' => 'required'
        ]);

        $page->update($validated);
        
        return redirect()->route('admin.profil.index')->with('success', 'Konten halaman berhasil diperbarui.');
    }
}
