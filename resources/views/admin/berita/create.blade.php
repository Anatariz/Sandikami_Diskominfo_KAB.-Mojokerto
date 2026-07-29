@extends('layouts.admin')

@section('title', 'Tulis Berita | Sandikami')
@section('page_title', 'Tulis Berita')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Tulis Berita Baru</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;"><a href="{{ route('admin.berita.index') }}" class="text-secondary">Berita</a> / Tulis Baru</p>
</div>

<div class="card">
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group mb-4">
            <label class="form-label" for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
            @error('judul') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="gambar">Gambar Cover (Opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="isi">Isi Berita</label>
            <textarea name="isi" id="isi" class="form-control @error('isi') is-invalid @enderror" rows="10" required>{{ old('isi') }}</textarea>
            @error('isi') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label" for="status">Status Publikasi</label>
            <select name="status" id="status" class="form-control">
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Tampil di publik)</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan sementara)</option>
            </select>
        </div>
        
        <div class="mt-4 pt-3" style="border-top: 1px solid var(--glass-border);">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan Berita</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>

@endsection
