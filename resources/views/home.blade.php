@extends('layouts.app')

@section('title', 'Beranda | Portal Sandikami')

@section('content')
<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <div class="hero-content">
      <span class="badge badge-secondary mb-3">Portal Resmi Sandikami</span>
      <h1 class="hero-title">Layanan Persandian & Keamanan Informasi</h1>
      <p class="hero-subtitle">Mewujudkan komunikasi dan informasi pemerintahan yang aman, terpercaya, dan andal di lingkungan Pemerintah Kabupaten Mojokerto.</p>
      <div class="hero-actions">
        <a href="#layanan-kami" class="btn btn-accent">Ajukan Layanan</a>
        <a href="{{ route('pengaduan') }}" class="btn btn-primary">Lapor Insiden</a>
      </div>
    </div>
  </div>
</section>

<!-- Ringkasan Layanan -->
<section class="section" id="layanan-kami">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="page-title">Layanan <span>Kami</span></h2>
      <p class="page-subtitle">Berbagai layanan kami untuk menjamin keamanan sistem dan informasi Pemerintah Kabupaten Mojokerto.</p>
    </div>
    
    <div class="services-grid">
      @forelse($layanans as $layanan)
      <div class="glass-card service-card">

        <h3>{{ $layanan->nama_layanan }}</h3>
        <p class="mb-3 text-text-muted">{{ Str::limit(strip_tags($layanan->deskripsi), 120) }}</p>
        <a href="{{ route('layanan.form', ['type' => $layanan->jenis_layanan]) }}" class="text-primary">Selengkapnya &rarr;</a>
      </div>
      @empty
        <div style="grid-column: 1 / -1; text-align: center; color: var(--color-text-muted); padding: 40px;">
            Belum ada layanan yang tersedia.
        </div>
      @endforelse
    </div>
    <div class="text-center mt-5">
    </div>
  </div>
</section>

<!-- Statistik -->
<section class="section stats-section" style="margin-bottom: 4rem;">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <h3>{{ $stats['tte'] }}</h3>
        <p>Pengguna Layanan TTE</p>
      </div>
      <div class="stat-item">
        <h3>{{ $stats['email'] }}</h3>
        <p>Pengguna Layanan Email</p>
      </div>
      <div class="stat-item">
        <h3>{{ $stats['assessment'] }}</h3>
        <p>Pelaksanaan Security Assesment</p>
      </div>
      <div class="stat-item">
        <h3>{{ $stats['insiden'] }}</h3>
        <p>Penanganan Insiden</p>
      </div>
    </div>
  </div>
</section>

<!-- Berita Terbaru -->
<section id="berita" class="section">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="page-title">Berita <span>Terbaru</span></h2>
      <p class="page-subtitle">Informasi dan berita terkini seputar keamanan siber dan layanan Sandikami.</p>
    </div>
    
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
            Belum ada berita terbaru.
        </div>
      @endforelse
    </div>
  </div>
</section>


@endsection

@push('styles')
<style>
  .hero { min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden; padding-top: 80px; }
  .hero-content { max-width: 800px; position: relative; z-index: 2; }
  .hero-title { font-size: 4rem; margin-bottom: 20px; background: linear-gradient(90deg, #FFFFFF, var(--color-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .hero-subtitle { font-size: 1.2rem; color: var(--color-text-muted); margin-bottom: 40px; }
  .hero-actions { display: flex; gap: 20px; flex-wrap: wrap; }
  .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 50px; }
  .service-card { text-align: center; }
  .service-icon { font-size: 3rem; color: var(--color-secondary); margin-bottom: 20px; display: inline-block; width: 80px; height: 80px; line-height: 80px; background: rgba(0, 216, 255, 0.1); border-radius: 50%; transition: all var(--transition-normal); }
  .service-card:hover .service-icon { background: var(--color-secondary); color: var(--color-primary); transform: scale(1.1); }
  .stats-section { background: linear-gradient(135deg, var(--color-primary-lighter), rgba(17, 34, 64, 0.5)); border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border); }
  .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center; }
  .stat-item h3 { font-size: 3.5rem; color: var(--color-accent); margin-bottom: 10px; }
  .stat-item p { color: var(--color-text); font-weight: 500; }
  .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
  .news-card { padding: 0; overflow: hidden; }
  .news-img { height: 200px; background: var(--color-primary-lighter); width: 100%; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted); }
  .news-content { padding: 25px; }
  .news-date { font-size: 0.85rem; color: var(--color-secondary); margin-bottom: 10px; display: block; }
  @media (max-width: 768px) { .hero-title { font-size: 2.5rem; } }
</style>
@endpush
