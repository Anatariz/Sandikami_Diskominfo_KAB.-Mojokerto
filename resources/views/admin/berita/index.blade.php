@extends('layouts.admin')

@section('title', 'Kelola Berita - Sandikami')
@section('page_title', 'Kelola Berita')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 1.25rem;">Daftar Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary" style="background-color: var(--primary); border-color: var(--primary);">
            <i class="ri-add-line"></i> Tambah Berita
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $berita)
                <tr>
                    <td>
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 80px; height: 60px; background-color: rgba(255,255,255,0.1); border-radius: 4px; display: flex; justify-content: center; align-items: center; color: var(--text-muted);">
                                <i class="ri-image-line" style="font-size: 1.5rem;"></i>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight: 600;">{{ $berita->judul }}</td>
                    <td>
                        @if($berita->status === 'published')
                            <span style="background-color: rgba(16, 185, 129, 0.2); color: #10B981; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Published</span>
                        @else
                            <span style="background-color: rgba(245, 158, 11, 0.2); color: #F59E0B; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Draft</span>
                        @endif
                    </td>
                    <td>{{ $berita->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-info" style="padding: 5px 10px; font-size: 0.8rem; background-color: #3498db; border-color: #3498db; color: white;" title="Edit">
                                <i class="ri-edit-line"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 10px; font-size: 0.8rem;" title="Hapus">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: var(--text-muted);">Belum ada data berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $beritas->links() }}
    </div>
</div>

@endsection
