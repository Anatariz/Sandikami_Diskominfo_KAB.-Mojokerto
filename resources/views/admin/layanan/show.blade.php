@extends('layouts.admin')
@section('title', 'Detail Layanan - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Detail Pengajuan Layanan</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="background-color: #95a5a6; border-color: #95a5a6; padding: 8px 15px; color: white; text-decoration: none; border-radius: 5px;">Kembali ke Dashboard</a>
    </div>

    <div class="card" style="padding: 30px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); border-radius: 10px;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color); width: 30%;">Jenis Layanan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: uppercase;"><strong>{{ $layanan->jenis_layanan }}</strong></td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Tanggal Pengajuan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->created_at->translatedFormat('d M Y H:i:s') }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Status</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                    @php
                        $statusLower = strtolower($layanan->status);
                        $bgColor = '#7f8c8d'; // abu-abu (menunggu/pending)
                        $textColor = 'white';
                        $statusText = ucfirst($layanan->status);
                        
                        if ($statusLower == 'diproses') {
                            $bgColor = '#f1c40f'; // kuning
                            $textColor = 'black';
                            $statusText = 'Diproses';
                        } elseif ($statusLower == 'selesai' || $statusLower == 'approved') {
                            $bgColor = '#2ecc71'; // hijau
                            $statusText = 'Selesai';
                        } elseif ($statusLower == 'ditolak' || $statusLower == 'rejected') {
                            $bgColor = '#e74c3c'; // merah
                            $statusText = 'Ditolak';
                        } elseif ($statusLower == 'pending' || $statusLower == 'menunggu') {
                            $statusText = 'Pending';
                        }
                    @endphp
                    <span class="badge" style="font-size: 1rem; padding: 5px 10px; background-color: {{ $bgColor }}; color: {{ $textColor }}; border-radius: 3px;">{{ $statusText }}</span>
                </td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Nama Lengkap</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->nama_lengkap }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">NIP / NIK</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->nip_nik ?? '-' }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Jabatan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Pangkat / Golongan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->pangkat_golongan ?? '-' }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Perangkat Daerah</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->perangkat_daerah }}</td>
            </tr>
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">No WA</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $layanan->no_wa }}</td>
            </tr>
            @if($layanan->file_lampiran)
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">File Lampiran</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                    <a href="{{ asset('storage/' . $layanan->file_lampiran) }}" target="_blank" class="btn btn-sm btn-primary" style="padding: 5px 10px; background-color: #3498db; color: white; text-decoration: none; border-radius: 3px;">Lihat Lampiran</a>
                </td>
            </tr>
            @endif
            @if($layanan->data_tambahan)
            <tr>
                <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Data Tambahan</th>
                <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($layanan->data_tambahan as $key => $value)
                            <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endif
        </table>
        <div style="margin-top: 1.5rem;">
            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-warning" style="background-color: #f1c40f; border-color: #f1c40f; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Edit Status / Data</a>
        </div>
    </div>
</div>
@endsection
