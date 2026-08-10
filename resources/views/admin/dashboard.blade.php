@extends('layouts.admin')

@section('title', 'Admin Dashboard - Sandikami')
@section('page_title', 'Panel Kontrol Administrator')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <!-- Card 1 -->
        <div class="card" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
            <div>
                <p style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">TOTAL PENGAJUAN</p>
                <h3 style="font-size: 1.8rem; color: var(--primary);">0</h3>
            </div>
            <div style="color: var(--primary); font-size: 1.5rem; opacity: 0.5;">
                <i class="ri-file-list-3-line"></i>
            </div>
        </div>

        <!-- Card 2 Removed -->

        <!-- Card 3 -->
        <div class="card" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid #e74c3c;">
            <div>
                <p style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">PENGADUAN BARU</p>
                <h3 style="font-size: 1.8rem; color: #e74c3c;">0</h3>
            </div>
            <div style="color: #e74c3c; font-size: 1.5rem; opacity: 0.5;">
                <i class="ri-feedback-line"></i>
            </div>
        </div>
    </div>

    <h2 class="mb-3">Daftar Pengajuan Layanan</h2>
    <div class="card p-0 mb-5" style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: rgba(255,255,255,0.1);">
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Layanan</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Pemohon</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Unit Kerja</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Status</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $l)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: uppercase;"><strong>{{ $l->jenis_layanan }}</strong></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->nama_lengkap }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->perangkat_daerah }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);"><span class="badge badge-secondary">{{ $l->status }}</span></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                        <a href="{{ route('admin.layanan.show', $l->id) }}" class="btn btn-sm btn-info" style="padding: 5px 10px; font-size: 0.8rem; background-color: #3498db; border-color: #3498db; color: white;">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--border-color);">Belum ada pengajuan layanan.</td>
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
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Kategori</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Judul</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Pelapor</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">No WA</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $p)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: capitalize;">{{ $p->kategori }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->judul }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->nama }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->wa }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                        <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info" style="padding: 5px 10px; font-size: 0.8rem; background-color: #3498db; border-color: #3498db; color: white; min-width: 70px; text-align: center; display: inline-block;">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--border-color);">Belum ada pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
