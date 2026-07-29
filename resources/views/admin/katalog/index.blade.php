@extends('layouts.admin')

@section('title', 'Katalog Layanan | Sandikami')
@section('page_title', 'Katalog Layanan')

@section('content')
<div class="card mb-4" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
    <div>
        <h2 class="mb-1" style="font-size: 1.25rem;">Katalog Layanan (Dynamic Forms)</h2>
        <p class="text-text-muted mb-0" style="font-size: 0.9rem;">Konfigurasi jenis layanan yang tersedia beserta field formulirnya.</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="alert('Fitur Drag & Drop Form Builder akan hadir di versi mendatang!')"><i class="ri-add-line mr-1"></i> Tambah Layanan</button>
    </div>
</div>

<div class="alert alert-info mb-4" style="background-color: rgba(0, 216, 255, 0.1); color: var(--color-text); border-left: 4px solid var(--color-secondary);">
    <i class="ri-information-line"></i> Saat ini, struktur formulir (JSON Schema) dimuat secara dinamis dari database. 
</div>

<div class="card p-0" style="overflow-x: auto;">
    <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(255,255,255,0.1);">
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Ikon</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Nama Layanan</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Jumlah Field</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Status</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($layanans as $layanan)
            <tr>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);"><i class="{{ $layanan->ikon }}" style="font-size: 1.5rem; color: var(--color-secondary);"></i></td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);">
                    <strong>{{ $layanan->nama_layanan }}</strong><br>
                    <small style="color: var(--color-text-muted);">{{ $layanan->deskripsi }}</small>
                </td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);">
                    {{ count($layanan->form_schema) }} Field Tambahan
                </td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);">
                    @if($layanan->status === 'active')
                        <span class="badge" style="background-color: #2ecc71; color: white;">Aktif</span>
                    @else
                        <span class="badge badge-secondary">Nonaktif</span>
                    @endif
                </td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border); text-align: right;">
                    <button class="btn btn-sm btn-info" onclick="alert('Fitur Edit JSON Schema sedang dalam pengembangan.')" style="background-color: #3498db; color: white; padding: 6px 12px; font-size: 0.8rem;">Edit Schema</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
