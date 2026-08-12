@extends('layouts.admin')

@section('title', 'Pantau Pengajuan Layanan - Sandikami')
@section('page_title', 'Pantau Pengajuan Layanan')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.layanan.index') }}" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end; background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color);">
        <div style="flex: 1; min-width: 150px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none; color-scheme: dark;">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Tanggal Selesai</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none; color-scheme: dark;">
        </div>
        <div style="flex: 2; min-width: 200px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Cari Pemohon / Layanan</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none;">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Status</label>
            <select name="status" class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none;">
                <option value="semua" style="color: black;" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua</option>
                <option value="pending" style="color: black;" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" style="color: black;" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" style="color: black;" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn" style="background-color: var(--primary); color: white; padding: 8px 20px; border-radius: 8px; border: none; cursor: pointer;"><i class="ri-search-line"></i> Filter</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn" style="background-color: rgba(255,255,255,0.1); color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none; border: 1px solid var(--border-color);"><i class="ri-refresh-line"></i> Reset</a>
        </div>
    </form>

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
