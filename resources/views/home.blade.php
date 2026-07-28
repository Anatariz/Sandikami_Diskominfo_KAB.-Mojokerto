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
        <a href="{{ route('layanan') }}" class="btn btn-accent">Ajukan Layanan</a>
        <a href="{{ route('pengaduan') }}" class="btn btn-primary">Lapor Insiden</a>
      </div>
    </div>
  </div>
</section>

<!-- Ringkasan Layanan -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="page-title">Ringkasan <span>Layanan</span></h2>
      <p class="page-subtitle">Berbagai layanan kami untuk menjamin keamanan sistem dan informasi Pemerintah Kabupaten Mojokerto.</p>
    </div>
    
    <div class="services-grid">
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-mail-secure-line"></i></div>
        <h3>E-Mail Pemda</h3>
        <p class="mb-3 text-text-muted">Penerbitan akun surat elektronik resmi @mojokertokab.go.id</p>
        <a href="{{ route('layanan.form', ['type'=>'email']) }}" class="text-primary">Selengkapnya &rarr;</a>
      </div>
      
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-fingerprint-line"></i></div>
        <h3>Tanda Tangan Elektronik</h3>
        <p class="mb-3 text-text-muted">Penerbitan sertifikat elektronik untuk pengesahan dokumen.</p>
        <a href="{{ route('layanan.form', ['type'=>'tte']) }}" class="text-primary">Selengkapnya &rarr;</a>
      </div>
      
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-bug-line"></i></div>
        <h3>Security Assessment</h3>
        <p class="mb-3 text-text-muted">Pengujian kerentanan (Vulnerability Assessment) aplikasi pemda.</p>
        <a href="{{ route('layanan.form', ['type'=>'assessment']) }}" class="text-primary">Selengkapnya &rarr;</a>
      </div>
      
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-macbook-line"></i></div>
        <h3>Layanan CSIRT</h3>
        <p class="mb-3 text-text-muted">Penanganan insiden keamanan informasi di lingkungan pemda.</p>
        <a href="{{ route('layanan.form', ['type'=>'csirt']) }}" class="text-primary">Selengkapnya &rarr;</a>
      </div>
    </div>
    <div class="text-center mt-5">
      <a href="{{ route('layanan') }}" class="btn btn-primary">Lihat Semua Layanan</a>
    </div>
  </div>
</section>

<!-- Statistik -->
<section class="section stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <h3>1,250+</h3>
        <p>Pengguna TTE</p>
      </div>
      <div class="stat-item">
        <h3>3,400+</h3>
        <p>Pengguna E-Mail</p>
      </div>
      <div class="stat-item">
        <h3>45+</h3>
        <p>Security Assessment</p>
      </div>
      <div class="stat-item">
        <h3>120+</h3>
        <p>Insiden Ditangani</p>
      </div>
    </div>
  </div>
</section>

<!-- Berita & Panduan Populer -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="page-title">Berita & <span>Panduan</span></h2>
      <p class="page-subtitle">Informasi terbaru seputar keamanan informasi dan panduan teknis layanan.</p>
    </div>
    
    <div class="news-grid">
      <!-- News Item 1 -->
      <div class="glass-card news-card">
        <div class="news-img">
          <i class="ri-image-line" style="font-size: 3rem;"></i>
        </div>
        <div class="news-content">
          <span class="news-date">12 Okt 2026</span>
          <h3 class="mb-2">Sosialisasi Keamanan Informasi Tingkat Desa</h3>
          <p class="text-text-muted mb-3">Diskominfo Kabupaten Mojokerto menggelar sosialisasi kesadaran keamanan informasi...</p>
          <a href="{{ route('berita') }}" class="text-primary">Baca Selengkapnya &rarr;</a>
        </div>
      </div>
      
      <!-- News Item 2 -->
      <div class="glass-card news-card">
        <div class="news-img">
          <i class="ri-file-list-3-line" style="font-size: 3rem;"></i>
        </div>
        <div class="news-content">
          <span class="badge badge-secondary mb-2">Panduan Populer</span>
          <h3 class="mb-2">SOP Penanganan Insiden Web Defacement</h3>
          <p class="text-text-muted mb-3">Langkah-langkah taktis saat website SKPD mengalami peretasan berupa perubahan halaman utama.</p>
          <a href="{{ route('panduan.sop') }}" class="text-primary">Lihat Panduan &rarr;</a>
        </div>
      </div>
      
      <!-- News Item 3 -->
      <div class="glass-card news-card">
        <div class="news-img">
          <i class="ri-file-list-3-line" style="font-size: 3rem;"></i>
        </div>
        <div class="news-content">
          <span class="badge badge-secondary mb-2">Panduan Populer</span>
          <h3 class="mb-2">Panduan Pendaftaran TTE BeSign</h3>
          <p class="text-text-muted mb-3">Tutorial lengkap langkah pendaftaran dan aktivasi sertifikat elektronik menggunakan aplikasi BeSign.</p>
          <a href="{{ route('panduan.sop') }}" class="text-primary">Lihat Panduan &rarr;</a>
        </div>
      </div>
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
