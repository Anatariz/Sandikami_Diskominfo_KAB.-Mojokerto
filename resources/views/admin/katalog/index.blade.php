@extends('layouts.admin')

@section('title', 'Katalog Layanan | Sandikami')
@section('page_title', 'Katalog Layanan')

@section('content')
<div class="card mb-4" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
    <div>
        <h2 class="mb-1" style="font-size: 1.25rem;">Katalog Layanan </h2>
        <p class="text-text-muted mb-0" style="font-size: 0.9rem;">Konfigurasi jenis layanan yang tersedia beserta field formulirnya.</p>
    </div>
    <div>
        <a href="{{ route('admin.katalog.create') }}" class="btn btn-primary"><i class="ri-add-line mr-1"></i> Tambah Layanan</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card p-0" style="overflow-x: auto;">
    <table class="table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jenis (Slug)</th>
                <th>Total Kolom Form</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($layanans as $layanan)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">

                        <div>
                            <strong>{{ $layanan->nama_layanan }}</strong>
                        </div>
                    </div>
                </td>
                <td><span style="background-color: rgba(0,0,0,0.2); padding: 3px 8px; border-radius: 4px; font-size: 0.8rem; font-family: monospace;">{{ $layanan->jenis_layanan }}</span></td>
                <td>
                    <span style="font-size: 0.9rem;">
                        {{ is_array($layanan->form_schema) ? count($layanan->form_schema) : 0 }} Kolom
                    </span>
                </td>
                <td>
                    @if($layanan->status == 'active')
                        <span style="color: #10B981; font-weight: 500; font-size: 0.85rem;"><i class="ri-checkbox-circle-line"></i> Aktif</span>
                    @else
                        <span style="color: var(--text-muted); font-size: 0.85rem;"><i class="ri-close-circle-line"></i> Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.katalog.edit', $layanan->id) }}" class="btn btn-sm btn-info" style="background-color: #3b82f6; color: white; padding: 5px 10px; font-size: 0.8rem; border: none;"><i class="ri-edit-line"></i> Edit</a>
                        <form action="{{ route('admin.katalog.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 10px; font-size: 0.8rem;"><i class="ri-delete-bin-line"></i> Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada layanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
