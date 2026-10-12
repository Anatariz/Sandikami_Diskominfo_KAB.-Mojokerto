@extends('layouts.app')

@section('title', $berita->judul . ' | Portal Sandikami')

@section('content')
<!-- Header -->
<header class="page-header" style="padding: 100px 0 60px;">
  <div class="container" style="max-width: 860px; margin: 0 auto;">
    <a href="{{ route('berita.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 20px; display: inline-flex; align-items: center; gap: 6px;"><i class="ri-arrow-left-line"></i> Kembali ke Berita</a>
    
    <span class="news-date mb-2" style="color: #bfdbfe; display: block; font-size: 0.95rem;"><i class="ri-calendar-event-line mr-1"></i> {{ $berita->created_at->format('d M Y') }}</span>
    <h1 class="page-title" style="text-align: left; font-size: 2.2rem; margin-bottom: 10px; color: #ffffff;">{{ $berita->judul }}</h1>
  </div>
</header>

<section class="section pt-0" style="margin-top: -30px;">
  <div class="container" style="max-width: 860px; margin: 0 auto;">
    <div class="glass-card" style="padding: 40px; box-shadow: var(--shadow-md);">
      @if($berita->gambar)
          <div style="width: 100%; border-radius: 12px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
              <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 100%; height: auto; display: block;">
          </div>
      @endif
      
      <div class="berita-content">
          {!! $berita->isi !!}
      </div>
    </div>
  </div>
</section>
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
