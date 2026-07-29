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
      
      @if(isset($global_layanans) && count($global_layanans) > 0)
        @foreach($global_layanans as $layanan)
        <div class="glass-card service-card">
          <div class="service-icon"><i class="{{ $layanan->ikon }}"></i></div>
          <h3>{{ $layanan->nama_layanan }}</h3>
          <p class="mb-4 text-text-muted">{{ $layanan->deskripsi }}</p>
          <a href="{{ route('layanan.form', ['type' => $layanan->jenis_layanan]) }}" class="btn btn-primary btn-block">Ajukan Permohonan</a>
        </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
            <p class="text-text-muted">Belum ada layanan yang ditambahkan.</p>
        </div>
      @endif

    </div>
  </div>
</section>
@endsection
