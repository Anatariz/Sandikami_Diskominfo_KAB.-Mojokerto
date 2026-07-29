@extends('layouts.app')

@section('title', 'Formulir Layanan | Sandikami')

@push('styles')
<style>
  .form-wrapper { max-width: 800px; margin: 0 auto; }
  .form-section-title { font-size: 1.2rem; color: var(--color-secondary); border-bottom: 1px solid var(--color-primary-lighter); padding-bottom: 10px; margin-bottom: 20px; margin-top: 30px; }
  .grid-2-cols { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  @media (max-width: 768px) { .grid-2-cols { grid-template-columns: 1fr; gap: 0; } }
</style>
@endpush

@section('content')
<!-- Header -->
<header class="page-header" style="padding: 100px 0 40px;">
  <div class="container">
    <h1 class="page-title">Formulir <span>{{ $layanan->nama_layanan }}</span></h1>
    <p class="page-subtitle">{{ $layanan->deskripsi }}</p>
  </div>
</header>

<!-- Form Content -->
<section class="section pt-0">
  <div class="container">
    <div class="form-wrapper glass-card">
      
      @if(session('success'))
        <div style="background-color: var(--color-success); color: white; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('layanan.submit', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h3 class="form-section-title"><i class="ri-user-line mr-2"></i>Data Pemohon</h3>
        <div class="grid-2-cols">
            <div class="form-group mb-4">
                <label class="form-label" for="nama">Nama Lengkap Pemohon *</label>
                <input type="text" id="nama" name="nama" class="form-control" required placeholder="Contoh: Budi Santoso, S.Kom">
            </div>
            <div class="form-group mb-4">
                <label class="form-label" for="nip">NIP / NIK</label>
                <input type="text" id="nip" name="nip" class="form-control" placeholder="Contoh: 198001012005011002">
            </div>
        </div>

        <div class="grid-2-cols">
            <div class="form-group mb-4">
                <label class="form-label" for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control">
            </div>
            <div class="form-group mb-4">
                <label class="form-label" for="pangkat">Pangkat / Golongan</label>
                <input type="text" id="pangkat" name="pangkat" class="form-control">
            </div>
        </div>

        <div class="form-group mb-4">
            <label class="form-label" for="opd">Perangkat Daerah / Unit Kerja *</label>
            <input type="text" id="opd" name="opd" class="form-control" required placeholder="Contoh: Dinas Komunikasi dan Informatika">
        </div>

        <div class="form-group mb-4">
            <label class="form-label" for="wa">Nomor WhatsApp Aktif *</label>
            <input type="tel" id="wa" name="wa" class="form-control" required placeholder="Contoh: 081234567890">
            <small style="color: var(--color-text-muted); font-size: 0.8rem; margin-top: 5px; display: block;">Untuk keperluan koordinasi teknis (wajib nomor aktif).</small>
        </div>

        <h3 class="form-section-title"><i class="ri-file-list-3-line mr-2"></i>Detail Layanan Spesifik</h3>
        
        @foreach($layanan->form_schema as $field)
            <div class="form-group mb-4">
                <label class="form-label" for="{{ $field['name'] }}">{{ $field['label'] }} {!! $field['required'] ? '*' : '' !!}</label>
                
                @if($field['type'] === 'textarea')
                    <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" rows="4" {{ $field['required'] ? 'required' : '' }}></textarea>
                @elseif($field['type'] === 'file')
                    <input type="file" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" {{ $field['required'] ? 'required' : '' }}>
                @else
                    <input type="{{ $field['type'] }}" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" {{ $field['required'] ? 'required' : '' }}>
                @endif
            </div>
        @endforeach

        <h3 class="form-section-title"><i class="ri-shield-check-line mr-2"></i>Pernyataan Persetujuan</h3>
        <div class="mb-3">
            <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; color: var(--color-text-muted);">
                <input type="checkbox" name="persetujuan" required style="margin-top: 5px;">
                <span>Saya menyetujui syarat dan ketentuan penggunaan layanan sistem elektronik Pemerintah Kabupaten Mojokerto dan bersedia mematuhi aturan keamanan informasi yang berlaku.</span>
            </label>
        </div>
        <div class="mb-4">
            <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; color: var(--color-text-muted);">
                <input type="checkbox" name="kebenaran" required style="margin-top: 5px;">
                <span>Saya menyatakan bahwa seluruh data yang diisi pada formulir ini adalah benar dan dapat dipertanggungjawabkan.</span>
            </label>
        </div>

        <div style="margin-top: 40px;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;"><i class="ri-send-plane-fill mr-2"></i>Kirim Pengajuan Layanan</button>
        </div>
        
      </form>
    </div>
  </div>
</section>
@endsection
