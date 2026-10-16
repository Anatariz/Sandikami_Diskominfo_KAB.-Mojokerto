@extends('layouts.admin')
@section('title', 'Edit Layanan - Sandikami')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 class="mb-0">Edit Pengajuan Layanan</h1>
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

    <div class="card">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="jenis_layanan" class="form-label">Jenis Layanan (Read Only)</label>
                <input type="text" id="jenis_layanan" class="form-control" style="background-color: #f8fafc;" value="{{ strtoupper($layanan->jenis_layanan) }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $layanan->nama_lengkap) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="perangkat_daerah" class="form-label">Perangkat Daerah</label>
                <input type="text" id="perangkat_daerah" name="perangkat_daerah" class="form-control" value="{{ old('perangkat_daerah', $layanan->perangkat_daerah) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Menunggu" {{ (old('status', $layanan->status) == 'Menunggu') ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ (old('status', $layanan->status) == 'Diproses') ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ (old('status', $layanan->status) == 'Selesai') ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ (old('status', $layanan->status) == 'Ditolak') ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 8px;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
