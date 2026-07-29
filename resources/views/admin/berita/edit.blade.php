@extends('layouts.admin')

@section('title', 'Edit Berita | Sandikami')
@section('page_title', 'Edit Berita')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Edit Berita: {{ $berita->judul }}</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;"><a href="{{ route('admin.berita.index') }}" class="text-secondary">Berita</a> / Edit / {{ $berita->judul }}</p>
</div>

<div class="card">
    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-4">
            <label class="form-label" for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
            @error('judul') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="gambar">Gambar Cover (Opsional)</label>
            @if($berita->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" style="max-height: 150px; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <small class="text-text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="isi">Isi Berita</label>
            <textarea name="isi" id="isi" class="form-control @error('isi') is-invalid @enderror" rows="10" required>{{ old('isi', $berita->isi) }}</textarea>
            @error('isi') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="status">Status Publikasi</label>
            <select name="status" id="status" class="form-control">
                <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Published (Tampil di publik)</option>
                <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft (Simpan sementara)</option>
            </select>
        </div>
        
        <div class="mt-4 pt-3" style="border-top: 1px solid var(--glass-border);">
            <button type="submit" class="btn btn-warning" style="background-color: #f1c40f; color: black; padding: 10px 20px;">Update Berita</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>

@endsection
