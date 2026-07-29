@extends('layouts.admin')

@section('title', 'Kelola Berita | Sandikami')
@section('page_title', 'Kelola Berita')

@section('content')
<div class="card mb-4" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
    <div>
        <h2 class="mb-1" style="font-size: 1.25rem;">Berita & Pengumuman</h2>
        <p class="text-text-muted mb-0" style="font-size: 0.9rem;">Manajemen konten berita yang tampil di halaman depan.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary"><i class="ri-add-line mr-1"></i> Tulis Berita</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mb-4" style="background-color: #2ecc71; color: white; padding: 15px; border-radius: 8px;">
    {{ session('success') }}
</div>
@endif

<div class="card p-0" style="overflow-x: auto;">
    <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(255,255,255,0.1);">
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Tanggal</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Judul</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border);">Status</th>
                <th style="padding: 15px; border-bottom: 1px solid var(--glass-border); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $berita)
            <tr>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);">{{ $berita->created_at->format('d M Y') }}</td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);"><strong>{{ $berita->judul }}</strong></td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border);">
                    @if($berita->status === 'published')
                        <span class="badge" style="background-color: #2ecc71; color: white;">Published</span>
                    @else
                        <span class="badge badge-secondary">Draft</span>
                    @endif
                </td>
                <td style="padding: 15px; border-bottom: 1px solid var(--glass-border); text-align: right;">
                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-warning" style="background-color: #f1c40f; color: black; padding: 6px 12px; font-size: 0.8rem;">Edit</a>
                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" style="background-color: #e74c3c; padding: 6px 12px; font-size: 0.8rem;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 30px; text-align: center; color: var(--color-text-muted);">Belum ada berita yang diterbitkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
