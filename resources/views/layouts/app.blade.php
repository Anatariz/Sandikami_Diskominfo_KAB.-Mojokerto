<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Portal Sandikami | Diskominfo Kab. Mojokerto')</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  @stack('styles')
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <div class="logo-icon">
          <i class="ri-shield-keyhole-line" style="font-size: 2rem; color: var(--color-secondary);"></i>
        </div>
        <div>
          <span class="logo-text">SANDIKAMI</span>
          <span class="logo-sub">Dinas Komunikasi Dan Informatika Kab. Mojokerto</span>
        </div>
      </a>
      
      <button class="menu-toggle">
        <i class="ri-menu-line"></i>
      </button>
      
      <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle {{ request()->routeIs('profil*') ? 'active' : '' }}">
            Profil <i class="ri-arrow-down-s-line"></i>
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('profil.tentang') }}" class="dropdown-item">Tentang Sandikami</a>
            <a href="{{ route('profil.tugas-fungsi') }}" class="dropdown-item">Tugas dan Fungsi</a>
            <a href="{{ route('profil.program-kerja') }}" class="dropdown-item">Program Kerja</a>
          </div>
        </div>
        <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle {{ request()->routeIs('layanan*') ? 'active' : '' }}">
            Layanan <i class="ri-arrow-down-s-line"></i>
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('layanan.form', ['type' => 'email']) }}" class="dropdown-item">Penerbitan Email Pemda</a>
            <a href="{{ route('layanan.form', ['type' => 'tte']) }}" class="dropdown-item">Pengajuan Tanda Tangan Elektronik</a>
            <a href="{{ route('layanan.form', ['type' => 'pentest']) }}" class="dropdown-item">Pengujian Keamanan Aplikasi</a>
            <a href="{{ route('layanan.form', ['type' => 'ssl']) }}" class="dropdown-item">Permohonan SSL</a>
            <a href="{{ route('layanan.form', ['type' => 'csirt']) }}" class="dropdown-item">Layanan CSIRT</a>
            <a href="{{ route('layanan.form', ['type' => 'awareness']) }}" class="dropdown-item">Security Awareness</a>
            <a href="{{ route('layanan.form', ['type' => 'konsultasi']) }}" class="dropdown-item">Konsultasi Keamanan Informasi</a>
            <a href="{{ route('layanan.form', ['type' => 'jamming']) }}" class="dropdown-item">Layanan Jamming</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle {{ request()->routeIs('panduan*') ? 'active' : '' }}">
            Panduan <i class="ri-arrow-down-s-line"></i>
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('panduan.insiden') }}" class="dropdown-item">Panduan Penanganan Insiden</a>
            <a href="{{ route('panduan.sop') }}" class="dropdown-item">SOP</a>
            <a href="{{ route('panduan.produk-hukum') }}" class="dropdown-item">Produk Hukum</a>
          </div>
        </div>
        <a href="{{ route('pengaduan') }}" class="{{ request()->routeIs('pengaduan') ? 'active' : '' }}">Pengaduan</a>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  @yield('content')

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="navbar-brand mb-3">
            <i class="ri-shield-keyhole-line" style="font-size: 1.5rem; color: var(--color-secondary);"></i>
            <div>
              <span class="logo-text" style="font-size: 1.2rem;">SANDIKAMI</span>
            </div>
          </div>
          <p class="text-text-muted mb-3">Dinas Komunikasi dan Informatika<br>Kabupaten Mojokerto</p>
          <p class="text-text-muted">Bidang Persandian dan Keamanan Informasi.</p>
        </div>
        
        <div>
          <h4 class="footer-title">Tautan Cepat</h4>
          <ul class="footer-links">
            <li><a href="{{ route('profil.tentang') }}">Profil Sandikami</a></li>
            <li><a href="{{ route('layanan') }}">Katalog Layanan</a></li>
            <li><a href="{{ route('panduan.sop') }}">SOP & Panduan</a></li>
            <li><a href="{{ route('pengaduan') }}">Lapor Insiden (CSIRT)</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="footer-title">Kontak Kami</h4>
          <ul class="footer-links">
            <li><i class="ri-map-pin-line text-primary"></i> Jl. Pemuda No.55, Mojokerto</li>
            <li><i class="ri-mail-line text-primary"></i> sandikami@mojokertokab.go.id</li>
            <li><i class="ri-phone-line text-primary"></i> (0321) 123456</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 Diskominfo Kabupaten Mojokerto. Hak Cipta Dilindungi.</p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
