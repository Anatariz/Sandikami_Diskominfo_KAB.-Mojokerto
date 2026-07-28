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
    <h1 class="page-title" id="formTitle">Formulir <span>Layanan</span></h1>
    <p class="page-subtitle" id="formDesc">Memuat informasi formulir layanan...</p>
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

      <form id="dynamicForm" action="{{ route('layanan.submit', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- JS will populate fields here -->
        <div id="formFieldsContainer"></div>
        
      </form>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  // Mengambil tipe form dari controller
  const formType = '{{ $type }}';
</script>
<script src="{{ asset('js/forms.js') }}?v={{ time() }}"></script>
@endpush
