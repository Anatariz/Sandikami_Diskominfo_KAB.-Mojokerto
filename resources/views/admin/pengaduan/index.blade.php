@extends('layouts.admin')

@section('title', 'Laporan Pengaduan - Sandikami')
@section('page_title', 'Laporan Pengaduan')

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
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Kategori</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Judul</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Pelapor</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">No WA</th>
                    <th style="padding: 12px; border-bottom: 1px solid var(--glass-border);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $p)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border); text-transform: capitalize;">{{ $p->kategori }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->judul }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->nama }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">{{ $p->wa }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid var(--glass-border);">
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
                    <td colspan="6" style="padding: 12px; text-align: center; border-bottom: 1px solid var(--glass-border);">Belum ada pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
