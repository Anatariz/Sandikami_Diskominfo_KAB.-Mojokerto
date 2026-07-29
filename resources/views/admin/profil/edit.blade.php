@extends('layouts.admin')

@section('title', 'Edit Profil Web | Sandikami')
@section('page_title', 'Edit Profil Web')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Edit Teks Profil: {{ $page->slug }}</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;"><a href="{{ route('admin.profil.index') }}" class="text-secondary">Edit Profil Web</a> / {{ $page->slug }}</p>
</div>

        <div class="card">
            <form action="{{ route('admin.profil.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label class="form-label" for="content">Isi Teks / Konten (Gunakan HTML jika perlu)</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="15" required style="font-family: monospace;">{{ old('content', $page->content) }}</textarea>
                    @error('content') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                
                <div class="mt-4 pt-3" style="border-top: 1px solid var(--glass-border);">
                    <button type="submit" class="btn btn-warning" style="background-color: #f1c40f; color: black; padding: 10px 20px;">Update Konten</button>
                    <a href="{{ route('admin.profil.index') }}" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
                </div>
            </form>
        </div>

@endsection
