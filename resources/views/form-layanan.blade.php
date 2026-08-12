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
    <p class="page-subtitle">{!! $layanan->deskripsi !!}</p>
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
        
        @php
            $schemaPemohon = isset($layanan->form_schema['pemohon']) ? $layanan->form_schema['pemohon'] : [];
            $schemaLayanan = isset($layanan->form_schema['layanan']) ? $layanan->form_schema['layanan'] : (isset($layanan->form_schema[0]) ? $layanan->form_schema : []);
        @endphp

        @if(count($schemaPemohon) > 0)
        <h3 class="form-section-title"><i class="ri-user-line mr-2"></i>Data Pemohon</h3>
        
        <div class="grid-2-cols">
            @foreach($schemaPemohon as $index => $field)
                <div class="form-group mb-4" @if(in_array($field['name'], ['perangkat_daerah', 'no_wa'])) style="grid-column: 1 / -1;" @endif>
                    <label class="form-label" for="{{ $field['name'] }}">{{ $field['label'] }} {!! $field['required'] ? '*' : '' !!}</label>
                    
                    @if($field['type'] === 'textarea')
                        <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" rows="4" {{ $field['required'] ? 'required' : '' }}>{{ old($field['name']) }}</textarea>
                    @elseif($field['type'] === 'select')
                        <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" {{ $field['required'] ? 'required' : '' }}>
                            <option value="" disabled selected>-- Pilih --</option>
                            @if(isset($field['options']) && is_array($field['options']))
                                @foreach($field['options'] as $opt)
                                    <option value="{{ $opt }}" {{ old($field['name']) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            @endif
                        </select>
                    @elseif($field['type'] === 'file')
                        <input type="file" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" {{ $field['required'] ? 'required' : '' }}>
                    @elseif($field['type'] === 'checkbox')
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="1" class="@error($field['name']) is-invalid @enderror" {{ old($field['name']) ? 'checked' : '' }} {{ $field['required'] ? 'required' : '' }}>
                            <span>Setuju</span>
                        </label>
                    @else
                        <input type="{{ $field['type'] }}" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name']) }}" {{ $field['required'] ? 'required' : '' }}>
                    @endif
                    @error($field['name']) <span class="text-danger" style="font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>
            @endforeach
        </div>
        @endif

        @if(count($schemaLayanan) > 0)
        <h3 class="form-section-title"><i class="ri-file-list-3-line mr-2"></i>Detail Layanan Spesifik</h3>
        
        @foreach($schemaLayanan as $field)
            <div class="form-group mb-4">
                <label class="form-label" for="{{ $field['name'] }}">{{ $field['label'] }} {!! $field['required'] ? '*' : '' !!}</label>
                
                @if($field['type'] === 'textarea')
                    <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" rows="4" {{ $field['required'] ? 'required' : '' }}>{{ old($field['name']) }}</textarea>
                @elseif($field['type'] === 'select')
                    <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" {{ $field['required'] ? 'required' : '' }}>
                        <option value="" disabled selected>-- Pilih --</option>
                        @if(isset($field['options']) && is_array($field['options']))
                            @foreach($field['options'] as $opt)
                                <option value="{{ $opt }}" {{ old($field['name']) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        @endif
                    </select>
                @elseif($field['type'] === 'file')
                    <input type="file" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" {{ $field['required'] ? 'required' : '' }}>
                @elseif($field['type'] === 'checkbox')
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="1" class="@error($field['name']) is-invalid @enderror" {{ old($field['name']) ? 'checked' : '' }} {{ $field['required'] ? 'required' : '' }}>
                        <span>Setuju</span>
                    </label>
                @else
                    <input type="{{ $field['type'] }}" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name']) }}" {{ $field['required'] ? 'required' : '' }}>
                @endif
                @error($field['name']) <span class="text-danger" style="font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
        @endforeach
        @endif

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
        
        <div class="mb-4">
            <label class="form-label">Verifikasi Captcha *</label>
            @php
                $num1 = rand(1, 9);
                $num2 = rand(1, 9);
            @endphp
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="background: var(--color-primary-lighter); padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 1.2rem; letter-spacing: 2px; user-select: none;">{{ $num1 }} + {{ $num2 }} =</span>
                <input type="hidden" name="captcha_expected" value="{{ $num1 + $num2 }}">
                <input type="number" name="captcha_answer" class="form-control" style="max-width: 150px;" required placeholder="Hasil">
            </div>
        </div>


        <div style="margin-top: 40px;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;"><i class="ri-send-plane-fill mr-2"></i>Kirim Pengajuan Layanan</button>
        </div>
        
      </form>
    </div>
  </div>
</section>

@if ($errors->any())
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const firstInvalid = document.querySelector('.is-invalid');
    if (firstInvalid) {
      firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
      firstInvalid.focus();
    }
  });
</script>
@endif
@endsection
