@extends('layouts.admin')
@section('title', 'Edit Pengaduan - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Edit Pengaduan / Laporan Insiden</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="background-color: #95a5a6; border-color: #95a5a6; padding: 8px 15px; color: white; text-decoration: none; border-radius: 5px;">Batal</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #e74c3c; color: white; padding: 15px; border-radius: 8px; margin-bottom: 1.5rem;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding: 30px; background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); border-radius: 10px;">
        <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3" style="margin-bottom: 1rem;">
                <label for="judul" style="display: block; margin-bottom: 5px;">Judul Laporan</label>
                <input type="text" id="judul" name="judul" class="form-control" style="width: 100%; padding: 10px; background-color: rgba(255,255,255,0.1); border: 1px solid var(--border-color); color: white; border-radius: 5px;" value="{{ old('judul', $pengaduan->judul) }}" required>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 1rem;">
                <label for="kategori" style="display: block; margin-bottom: 5px;">Kategori</label>
                <select id="kategori" name="kategori" class="form-control" style="width: 100%; padding: 10px; background-color: var(--color-primary); border: 1px solid var(--border-color); color: white; border-radius: 5px;" required>
                    <option value="" disabled>-- Pilih Kategori --</option>
                    <option value="insiden keamanan informasi" {{ (old('kategori', $pengaduan->kategori) == 'insiden keamanan informasi') ? 'selected' : '' }}>Insiden keamanan informasi</option>
                    <option value="kendala email pemda" {{ (old('kategori', $pengaduan->kategori) == 'kendala email pemda') ? 'selected' : '' }}>Kendala email Pemda</option>
                    <option value="kendala tte" {{ (old('kategori', $pengaduan->kategori) == 'kendala tte') ? 'selected' : '' }}>Kendala TTE</option>
                    <option value="website/aplikasi terindikasi diretas" {{ (old('kategori', $pengaduan->kategori) == 'website/aplikasi terindikasi diretas') ? 'selected' : '' }}>Website/aplikasi terindikasi diretas</option>
                    <option value="dugaan phishing" {{ (old('kategori', $pengaduan->kategori) == 'dugaan phishing') ? 'selected' : '' }}>Dugaan phishing</option>
                    <option value="permintaan konsultasi" {{ (old('kategori', $pengaduan->kategori) == 'permintaan konsultasi') ? 'selected' : '' }}>Permintaan konsultasi</option>
                    <option value="lainnya" {{ (old('kategori', $pengaduan->kategori) == 'lainnya') ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 1rem;">
                <label for="nama" style="display: block; margin-bottom: 5px;">Nama Pelapor</label>
                <input type="text" id="nama" name="nama" class="form-control" style="width: 100%; padding: 10px; background-color: rgba(255,255,255,0.1); border: 1px solid var(--border-color); color: white; border-radius: 5px;" value="{{ old('nama', $pengaduan->nama) }}" required>
            </div>
            
            <div class="form-group mb-3" style="margin-bottom: 1rem;">
                <label for="wa" style="display: block; margin-bottom: 5px;">No. WhatsApp</label>
                <input type="text" id="wa" name="wa" class="form-control" style="width: 100%; padding: 10px; background-color: rgba(255,255,255,0.1); border: 1px solid var(--border-color); color: white; border-radius: 5px;" value="{{ old('wa', $pengaduan->wa) }}" required>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 1.5rem;">
                <label for="pesan" style="display: block; margin-bottom: 5px;">Pesan / Detail Kejadian</label>
                <textarea id="pesan" name="pesan" rows="5" class="form-control" style="width: 100%; padding: 10px; background-color: rgba(255,255,255,0.1); border: 1px solid var(--border-color); color: white; border-radius: 5px;" required>{{ old('pesan', $pengaduan->pesan) }}</textarea>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 1.5rem;">
                <label for="status" style="display: block; margin-bottom: 5px;">Status</label>
                <select id="status" name="status" class="form-control" style="width: 100%; padding: 10px; background-color: var(--color-primary); border: 1px solid var(--border-color); color: white; border-radius: 5px;" required>
                    <option value="Pending" {{ (old('status', $pengaduan->status) == 'Pending') ? 'selected' : '' }}>Pending</option>
                    <option value="Diproses" {{ (old('status', $pengaduan->status) == 'Diproses') ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ (old('status', $pengaduan->status) == 'Selesai') ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ (old('status', $pengaduan->status) == 'Ditolak') ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success" style="background-color: #2ecc71; border-color: #2ecc71; padding: 10px 20px; color: white; border-radius: 5px; border: none; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
