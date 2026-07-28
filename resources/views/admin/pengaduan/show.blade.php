@extends('layouts.app')
@section('title', 'Detail Pengaduan - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Detail Pengaduan / Laporan Insiden</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="background-color: #95a5a6; border-color: #95a5a6; padding: 8px 15px; color: white; text-decoration: none; border-radius: 5px;">Kembali ke Dashboard</a>
    </div>

    <div class="card p-4" style="background-color: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 10px;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border); width: 30%;">Judul Laporan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);"><strong>{{ $pengaduan->judul }}</strong></td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Tanggal Pelaporan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $pengaduan->created_at->format('d M Y H:i:s') }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Kategori</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border); text-transform: capitalize;">{{ $pengaduan->kategori }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Nama Pelapor</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $pengaduan->nama }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">No WA / Telepon</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $pengaduan->wa }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Pesan / Detail Kejadian</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border); white-space: pre-line;">{{ $pengaduan->pesan }}</td>
            </tr>
            @if($pengaduan->lampiran)
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">File Lampiran</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">
                    <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" class="btn btn-sm btn-primary" style="padding: 5px 10px; background-color: #3498db; color: white; text-decoration: none; border-radius: 3px;">Lihat Lampiran</a>
                </td>
            </tr>
            @endif
        </table>
        <div class="mt-4" style="margin-top: 1.5rem;">
            <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}" class="btn btn-warning" style="background-color: #f1c40f; border-color: #f1c40f; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Edit Data</a>
        </div>
    </div>
</div>
@endsection
