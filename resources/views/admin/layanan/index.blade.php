@extends('layouts.admin')

@section('title', 'Pantau Pengajuan Layanan - Sandikami')
@section('page_title', 'Pantau Pengajuan Layanan')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

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

@endsection
