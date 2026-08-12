<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayananRequest;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    public function index()
    {
        $layanans = LayananRequest::orderBy('created_at', 'desc')->take(5)->get();
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->take(5)->get();
        
        $total_pengajuan = LayananRequest::count();
        $total_pengaduan = Pengaduan::count();
        
        return view('admin.dashboard', compact('layanans', 'pengaduans', 'total_pengajuan', 'total_pengaduan'));
    }

    public function indexLayanan(Request $request)
    {
        $query = LayananRequest::query();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_layanan', 'like', '%' . $request->search . '%')
                  ->orWhere('perangkat_daerah', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $layanans = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('admin.layanan.index', compact('layanans'));
    }

    public function indexPengaduan(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('judul', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('admin.pengaduan.index', compact('pengaduans'));
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

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function editPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    public function updatePengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'wa' => 'required|string|max:20',
            'kategori' => 'required|string|max:255',
            'pesan' => 'required|string',
            'status' => 'required|string',
        ]);

        $pengaduan->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Data pengaduan berhasil diperbarui.');
    }

    public function destroyPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pengaduan berhasil dihapus.');
    }
}
