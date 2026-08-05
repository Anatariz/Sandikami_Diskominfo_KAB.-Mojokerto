<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function index()
    {
        $pages = \App\Models\PageContent::whereIn('slug', ['panduan-insiden', 'panduan-sop', 'panduan-produk-hukum'])->get();
        return view('admin.panduan.index', compact('pages'));
    }

    public function edit(string $id)
    {
        $page = \App\Models\PageContent::findOrFail($id);
        return view('admin.panduan.edit', compact('page'));
    }

    public function update(Request $request, string $id)
    {
        $page = \App\Models\PageContent::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        $page->update($validated);
        
        return redirect()->route('admin.panduan.index')->with('success', 'Konten panduan berhasil diperbarui.');
    }
}
