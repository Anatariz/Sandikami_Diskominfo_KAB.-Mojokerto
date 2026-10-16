@extends('layouts.admin')

@section('title', 'Pantau Pengajuan Layanan - Sandikami')
@section('page_title', 'Pantau Pengajuan Layanan')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.layanan.index') }}" class="admin-filter-card">
        <div style="flex: 1; min-width: 150px;">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label>Tanggal Selesai</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div style="flex: 2; min-width: 200px;">
            <label>Cari Pemohon / Layanan</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="form-control">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="padding: 9px 20px; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px;"><i class="ri-search-line"></i> Filter</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary" style="padding: 9px 20px; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px;"><i class="ri-refresh-line"></i> Reset</a>
        </div>
    </form>

    <div class="card p-0 mb-5" style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr>
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
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->created_at->translatedFormat('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: uppercase;"><strong>{{ $l->jenis_layanan }}</strong></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->nama_lengkap }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $l->perangkat_daerah }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);"><span class="badge badge-secondary">{{ $l->status }}</span></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
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
                    <td colspan="6" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--border-color);">Belum ada pengajuan layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: center;">
        {{ $layanans->links('pagination::bootstrap-5') }}
    </div>


@endsection
