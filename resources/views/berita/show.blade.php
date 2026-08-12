@extends('layouts.app')

@section('title', $berita->judul . ' | Portal Sandikami')

@section('content')
<!-- Header -->
<header class="page-header" style="padding: 100px 0 40px;">
  <div class="container" style="max-width: 800px; margin: 0 auto;">
    <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary mb-4"><i class="ri-arrow-left-line mr-1"></i> Kembali ke Berita</a>
    
    <span class="news-date mb-3" style="color: var(--color-secondary); display: block;"><i class="ri-calendar-event-line mr-1"></i> {{ $berita->created_at->format('d M Y') }}</span>
    <h1 class="page-title" style="text-align: left; font-size: 2.5rem; margin-bottom: 20px;">{{ $berita->judul }}</h1>
    
    @if($berita->gambar)
        <div style="width: 100%; border-radius: 12px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 100%; height: auto; display: block;">
        </div>
    @endif
    
    <div class="berita-content">
        {!! $berita->isi !!}
    </div>
  </div>
</header>
@endsection

@push('styles')
<style>
  .berita-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: var(--color-text);
  }
  .berita-content p {
      margin-bottom: 20px;
  }
  .berita-content img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin: 20px 0;
  }
</style>
@endpush
