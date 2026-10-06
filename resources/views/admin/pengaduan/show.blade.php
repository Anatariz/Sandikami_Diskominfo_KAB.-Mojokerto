@extends('layouts.admin')
@section('title', 'Detail Pengaduan - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Detail Pengaduan / Laporan Insiden</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="background-color: #95a5a6; border-color: #95a5a6; padding: 8px 15px; color: white; text-decoration: none; border-radius: 5px;">Kembali ke Dashboard</a>
    </div>

    {{-- ===== KARTU AKUN PENGGUNA ===== --}}
    @if($pengaduan->user)
    <div style="
        background: linear-gradient(135deg, rgba(231,76,60,0.12) 0%, rgba(155,89,182,0.12) 100%);
        border: 1px solid rgba(231,76,60,0.35);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 18px;
    ">
        {{-- Avatar / Inisial --}}
        <div style="
            width: 54px; height: 54px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, #e74c3c, #9b59b6);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; font-weight: 700; color: white; text-transform: uppercase;
        ">
            @if($pengaduan->user->avatar)
                <img src="{{ asset('storage/' . $pengaduan->user->avatar) }}"
                     alt="Avatar" style="width:54px;height:54px;border-radius:50%;object-fit:cover;">
            @else
                {{ mb_substr($pengaduan->user->name, 0, 1) }}
            @endif
        </div>
        {{-- Info Akun --}}
        <div style="flex:1; min-width:0;">
            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: #e74c3c; font-weight: 600; margin-bottom: 2px;">
                🔗 Dilaporkan oleh Akun Terdaftar
            </div>
            <div style="font-size: 1.05rem; font-weight: 700; margin-bottom: 2px;">
                {{ $pengaduan->user->name }}
            </div>
            <div style="font-size: 0.88rem; opacity: 0.75; word-break: break-all;">
                {{ $pengaduan->user->email }}
            </div>
            @if($pengaduan->user->jabatan || $pengaduan->user->divisi)
            <div style="font-size: 0.83rem; opacity: 0.65; margin-top: 2px;">
                {{ $pengaduan->user->jabatan }}{{ ($pengaduan->user->jabatan && $pengaduan->user->divisi) ? ' — ' : '' }}{{ $pengaduan->user->divisi }}
            </div>
            @endif
        </div>
        {{-- Badge Role --}}
        <div style="flex-shrink:0;">
            <span style="
                display: inline-block;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.78rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                {{ $pengaduan->user->role === 'admin'
                    ? 'background: rgba(231,76,60,0.2); color: #e74c3c; border: 1px solid rgba(231,76,60,0.4);'
                    : 'background: rgba(46,204,113,0.2); color: #2ecc71; border: 1px solid rgba(46,204,113,0.4);' }}
            ">
                {{ $pengaduan->user->role === 'admin' ? '👑 Admin' : '👤 User' }}
            </span>
        </div>
    </div>
    @else
    <div style="
        background: rgba(127,140,141,0.1);
        border: 1px solid rgba(127,140,141,0.3);
        border-radius: 10px;
        padding: 14px 20px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        opacity: 0.65;
    ">
        ⚠️ Data akun pengguna tidak ditemukan (akun mungkin sudah dihapus).
    </div>
    @endif

    {{-- ===== DETAIL PENGADUAN ===== --}}
    <div class="card" style="padding: 30px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); border-radius: 10px;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color); width: 30%;">Judul Laporan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);"><strong>{{ $pengaduan->judul }}</strong></td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Tanggal Pelaporan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $pengaduan->created_at->translatedFormat('d M Y H:i:s') }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Status</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                    @php
                        $statusLower = strtolower($pengaduan->status ?? 'pending');
                        $bgColor = '#7f8c8d';
                        $textColor = 'white';
                        $statusText = ucfirst($pengaduan->status ?? 'Pending');
                        if ($statusLower == 'diproses') {
                            $bgColor = '#f1c40f';
                            $textColor = 'black';
                            $statusText = 'Diproses';
                        } elseif ($statusLower == 'selesai' || $statusLower == 'approved') {
                            $bgColor = '#2ecc71';
                            $statusText = 'Selesai';
                        } elseif ($statusLower == 'ditolak' || $statusLower == 'rejected') {
                            $bgColor = '#e74c3c';
                            $statusText = 'Ditolak';
                        } elseif ($statusLower == 'pending' || $statusLower == 'menunggu') {
                            $statusText = 'Pending';
                        }
                    @endphp
                    <span class="badge" style="font-size: 1rem; padding: 5px 10px; background-color: {{ $bgColor }}; color: {{ $textColor }}; border-radius: 3px;">{{ $statusText }}</span>
                </td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Kategori</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: capitalize;">{{ $pengaduan->kategori }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Nama Pelapor</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $pengaduan->nama }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">No WA / Telepon</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $pengaduan->wa }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Pesan / Detail Kejadian</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color); white-space: pre-line;">{{ $pengaduan->pesan }}</td>
            </tr>
            @if($pengaduan->lampiran)
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">File Lampiran</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                    <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" class="btn btn-sm btn-primary" style="padding: 5px 10px; background-color: #3498db; color: white; text-decoration: none; border-radius: 3px;">Lihat Lampiran</a>
                </td>
            </tr>
            @endif
        </table>
        <div style="margin-top: 1.5rem;">
            <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}" class="btn btn-warning" style="background-color: #f1c40f; border-color: #f1c40f; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Edit Data</a>
        </div>
    </div>
</div>
@endsection
