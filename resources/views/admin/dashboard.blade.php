@extends('layouts.app')
@section('title', 'Admin Dashboard - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Admin Dashboard</h1>
        
        <div style="display: flex; align-items: center; gap: 15px;">
            <span>Halo, <strong>{{ auth()->user()->name ?? 'Admin' }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger" style="background-color: #e74c3c; border-color: #e74c3c; padding: 8px 15px;">
                    <i class="ri-logout-box-line mr-1"></i> Keluar
                </button>
            </form>
        </div>
    </div>
    
    <div class="alert alert-info mb-4" style="background-color: var(--color-primary-lighter); padding: 15px; border-radius: 8px;">
        <strong>Perhatian:</strong> Halaman ini adalah area admin untuk melihat pengajuan layanan dan pengaduan.
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4" style="background-color: #2ecc71; color: white; padding: 15px; border-radius: 8px; border: none;">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-3">Daftar Pengajuan Layanan</h2>
    <div class="card p-0 mb-5" style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: rgba(255,255,255,0.1);">
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Layanan</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Pemohon</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Unit Kerja</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Status</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $l)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $l->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border); text-transform: uppercase;"><strong>{{ $l->jenis_layanan }}</strong></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $l->nama_lengkap }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $l->perangkat_daerah }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);"><span class="badge badge-secondary">{{ $l->status }}</span></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">
                        <a href="{{ route('admin.layanan.show', $l->id) }}" class="btn btn-sm btn-info" style="padding: 5px 10px; font-size: 0.8rem; background-color: #3498db; border-color: #3498db; color: white;">Detail</a>
                        <a href="{{ route('admin.layanan.edit', $l->id) }}" class="btn btn-sm btn-warning" style="padding: 5px 10px; font-size: 0.8rem; background-color: #f1c40f; border-color: #f1c40f; color: black;">Edit</a>
                        <form action="{{ route('admin.layanan.destroy', $l->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 10px; font-size: 0.8rem; background-color: #e74c3c; border-color: #e74c3c; color: white;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--glass-border);">Belum ada pengajuan layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mb-3">Daftar Pengaduan / Laporan Insiden</h2>
    <div class="card p-0" style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: rgba(255,255,255,0.1);">
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Kategori</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Judul</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Pelapor</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">No WA</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $p)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border); text-transform: capitalize;">{{ $p->kategori }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->judul }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->nama }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->wa }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--glass-border);">Belum ada pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
