@extends('layouts.app')

@section('title', 'Berita | Portal Sandikami')

@section('content')
<!-- Header -->
<header class="page-header" style="padding: 100px 0 40px; text-align: center;">
  <div class="container">
    <h1 class="page-title">Kumpulan <span>Berita</span></h1>
    <p class="page-subtitle">Informasi dan berita terkini seputar keamanan siber dan layanan Sandikami.</p>
  </div>
</header>

<!-- Berita List -->
<section class="section pt-0">
  <div class="container">
    <div class="news-grid">
      @forelse($beritas as $berita)
      <div class="glass-card news-card">
        <div class="news-img">
          @if($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
          @else
            <i class="ri-newspaper-line" style="font-size: 3rem;"></i>
          @endif
        </div>
        <div class="news-content">
          <span class="news-date"><i class="ri-calendar-event-line mr-1"></i> {{ $berita->created_at->format('d M Y') }}</span>
          <h3 style="font-size: 1.1rem; margin-bottom: 10px;">{{ $berita->judul }}</h3>
          <p class="text-text-muted" style="font-size: 0.9rem;">{{ Str::limit($berita->ringkasan, 100) }}</p>
          <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-sm btn-outline-primary mt-3">Baca Selengkapnya</a>
        </div>
      </div>
      @empty
        <div style="grid-column: 1 / -1; text-align: center; color: var(--color-text-muted); padding: 40px;">
            Belum ada berita yang diterbitkan.
        </div>
      @endforelse
    </div>
    
    <div style="margin-top: 40px; display: flex; justify-content: center;">
        {{ $beritas->links() }}
    </div>
  </div>
</section>
@endsection

@push('styles')
<style>
  .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
  .news-card { padding: 0; overflow: hidden; display: flex; flex-direction: column; }
  .news-img { height: 200px; background: var(--color-primary-lighter); width: 100%; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted); }
  .news-content { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
  .news-date { font-size: 0.85rem; color: var(--color-secondary); margin-bottom: 10px; display: block; }
  .news-content a.btn { margin-top: auto; align-self: flex-start; }
</style>
@endpush
