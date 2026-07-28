<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananRequest;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    public function index()
    {
        $layanans = LayananRequest::orderBy('created_at', 'desc')->get();
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        
        return view('admin.dashboard', compact('layanans', 'pengaduans'));
    }

    public function showLayanan($id)
    {
        $layanan = LayananRequest::findOrFail($id);
        return view('admin.layanan.show', compact('layanan'));
    }

    public function editLayanan($id)
    {
        $layanan = LayananRequest::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function updateLayanan(Request $request, $id)
    {
        $layanan = LayananRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string',
        ]);

        $layanan->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroyLayanan($id)
    {
        $layanan = LayananRequest::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data layanan berhasil dihapus.');
    }
}
