@extends('layouts.app')

@section('title', 'Katalog Layanan | Sandikami')

@section('content')
<!-- Header -->
<header class="page-header">
  <div class="container">
    <h1 class="page-title">Katalog <span>Layanan</span></h1>
    <p class="page-subtitle">Ajukan permohonan layanan persandian dan keamanan informasi bagi perangkat daerah dengan mudah dan cepat melalui portal resmi kami.</p>
  </div>
</header>

<!-- Layanan Grid -->
<section class="section pt-0">
  <div class="container">
    <div class="services-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
      
      <!-- Layanan Email -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-mail-add-line"></i></div>
        <h3>Penerbitan E-Mail Pemda</h3>
        <p class="mb-4 text-text-muted">Layanan pengajuan pembuatan akun surat elektronik resmi dengan domain @mojokertokab.go.id.</p>
        <a href="{{ route('layanan.form', ['type'=>'email']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- Layanan TTE -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-fingerprint-2-line"></i></div>
        <h3>Pengajuan TTE</h3>
        <p class="mb-4 text-text-muted">Penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE).</p>
        <a href="{{ route('layanan.form', ['type'=>'tte']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- Security Assessment -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-search-eye-line"></i></div>
        <h3>IT Security Assessment</h3>
        <p class="mb-4 text-text-muted">Pengujian keamanan (Vulnerability Assessment) terhadap website atau aplikasi pemda.</p>
        <a href="{{ route('layanan.form', ['type'=>'assessment']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- SSL -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-lock-2-line"></i></div>
        <h3>Permohonan SSL</h3>
        <p class="mb-4 text-text-muted">Pengajuan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website pemda.</p>
        <a href="{{ route('layanan.form', ['type'=>'ssl']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- Security Awareness -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-group-line"></i></div>
        <h3>Security Awareness</h3>
        <p class="mb-4 text-text-muted">Sosialisasi, edukasi, bimtek, workshop mengenai keamanan informasi.</p>
        <a href="{{ route('layanan.form', ['type'=>'awareness']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- Jamming -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-rfid-line"></i></div>
        <h3>Layanan Jamming</h3>
        <p class="mb-4 text-text-muted">Dukungan pengamanan komunikasi melalui perangkat kontra penginderaan pada kegiatan strategis.</p>
        <a href="{{ route('layanan.form', ['type'=>'jamming']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>
      
      <!-- CSIRT -->
      <div class="glass-card service-card">
        <div class="service-icon"><i class="ri-macbook-line"></i></div>
        <h3>Layanan CSIRT</h3>
        <p class="mb-4 text-text-muted">Penanganan dan mitigasi insiden keamanan informasi di lingkungan Pemkab Mojokerto.</p>
        <a href="{{ route('layanan.form', ['type'=>'csirt']) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
      </div>

    </div>
  </div>
</section>
@endsection
