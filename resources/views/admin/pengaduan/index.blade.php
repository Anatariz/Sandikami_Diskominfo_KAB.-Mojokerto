@extends('layouts.admin')

@section('title', 'Laporan Pengaduan - Sandikami')
@section('page_title', 'Laporan Pengaduan')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.pengaduan.index') }}" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end; background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color);">
        <div style="flex: 1; min-width: 150px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none; color-scheme: dark;">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Tanggal Selesai</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control" style="width: 100%; padding: 8px 12px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px; outline: none; color-scheme: dark;">
        </div>
        <div style="flex: 2; min-width: 200px;">
            <label style="font-size: 0.85rem; margin-bottom: 5px; display: block;">Cari Pelapor / Judul</label>
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
            <a href="{{ route('admin.pengaduan.index') }}" class="btn" style="background-color: rgba(255,255,255,0.1); color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none; border: 1px solid var(--border-color);"><i class="ri-refresh-line"></i> Reset</a>
        </div>
    </form>

    <div class="card p-0 mb-5" style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: rgba(255,255,255,0.1);">
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Kategori</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Judul</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Pelapor</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Status</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $p)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->created_at->translatedFormat('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color); text-transform: capitalize;">{{ $p->kategori }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->judul }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">{{ $p->nama }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);"><span class="badge badge-secondary">{{ ucfirst($p->status ?? 'Pending') }}</span></td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--border-color);">
                        <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info" style="padding: 5px 10px; font-size: 0.8rem; background-color: #3498db; border-color: #3498db; color: white; min-width: 70px; text-align: center; display: inline-block;">Detail</a>
                        <a href="{{ route('admin.pengaduan.edit', $p->id) }}" class="btn btn-sm btn-warning" style="padding: 5px 10px; font-size: 0.8rem; background-color: #f1c40f; border-color: #f1c40f; color: black; min-width: 70px; text-align: center; display: inline-block;">Edit</a>
                        <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 10px; font-size: 0.8rem; background-color: #e74c3c; border-color: #e74c3c; color: white; min-width: 70px; text-align: center; display: inline-block;">Hapus</button>
                        </form>
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

    <div style="margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: center;">
        {{ $pengaduans->links('pagination::bootstrap-5') }}
    </div>


@endsection
