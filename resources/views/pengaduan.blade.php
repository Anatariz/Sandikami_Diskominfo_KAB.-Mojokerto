@extends('layouts.app')

@section('title', 'Formulir Pengaduan | Sandikami')

@section('content')
<header class="page-header" style="padding: 100px 0 40px;">
  <div class="container">
    <h1 class="page-title">Formulir <span>Pengaduan</span></h1>
    <p class="page-subtitle">Sampaikan keluhan, kendala, atau laporan terkait seluruh layanan Persandian dan Keamanan Informasi.</p>
  </div>
</header>

<section class="section pt-0">
  <div class="container">
    <div class="glass-card" style="max-width: 800px; margin: 0 auto;">
      
      @if(session('success'))
        <div style="background-color: var(--color-success); color: white; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('pengaduan.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label class="form-label" for="judul">Judul Pengajuan <span class="text-danger">*</span></label>
          <input type="text" id="judul" name="judul" class="form-control" required placeholder="Contoh: Kendala Lupa Password Akun TTE">
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="form-label" for="nama">Nama Pelapor <span class="text-danger">*</span></label>
            <input type="text" id="nama" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="wa">No. WhatsApp <span class="text-danger">*</span></label>
            <input type="tel" id="wa" name="wa" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="kategori">Kategori Pengajuan <span class="text-danger">*</span></label>
          <select id="kategori" name="kategori" class="form-control" required>
            <option value="" disabled selected>-- Pilih Kategori --</option>
            <option value="insiden">Insiden keamanan informasi</option>
            <option value="email">Kendala email Pemda</option>
            <option value="tte">Kendala TTE</option>
            <option value="retas">Website/aplikasi terindikasi diretas</option>
            <option value="phishing">Dugaan phishing</option>
            <option value="konsultasi">Permintaan konsultasi</option>
            <option value="lainnya">Lainnya</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="pesan">Pesan / Detail Kendala <span class="text-danger">*</span></label>
          <textarea id="pesan" name="pesan" class="form-control" rows="5" required placeholder="Jelaskan permasalahan Anda secara rinci..."></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Lampiran Bukti (Opsional)</label>
          <div class="file-upload-wrapper">
            <div class="file-upload-display">
              <i class="ri-upload-cloud-2-line mr-2" style="font-size: 1.5rem; margin-right: 10px;"></i>
              <span>Upload Screenshot/File Pendukung</span>
            </div>
            <input type="file" name="lampiran" id="lampiran">
          </div>
        </div>

        <hr style="border-color: var(--glass-border); margin: 30px 0;">
        
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="kebenaran" id="kebenaran" required>
            <label class="form-check-label" for="kebenaran">Saya menyatakan bahwa laporan ini benar dan dapat dipertanggungjawabkan.</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="persetujuan" id="persetujuan" required>
            <label class="form-check-label" for="persetujuan">Saya menyetujui pemrosesan data untuk keperluan tindak lanjut pengaduan.</label>
          </div>
        </div>

        <div class="form-group" style="max-width: 200px;">
          <label class="form-label">Captcha</label>
          <div style="background: rgba(0,0,0,0.5); padding: 10px; text-align: center; font-family: monospace; letter-spacing: 5px; font-size: 1.2rem; margin-bottom: 10px; border-radius: 4px; color: #fff;">
            M 4 Q 8 A
          </div>
          <input type="text" class="form-control" placeholder="Masukkan kode" required>
        </div>

        <div style="margin-top: 30px;">
          <button type="submit" class="btn btn-accent btn-block" style="padding: 15px; font-size: 1.1rem;"><i class="ri-send-plane-fill mr-2"></i> Kirim Laporan Pengaduan</button>
        </div>

      </form>
    </div>
  </div>
</section>
@endsection
