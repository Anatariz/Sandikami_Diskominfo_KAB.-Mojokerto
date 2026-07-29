@extends('layouts.app')

@section('title', 'Daftar Akun | Sandikami')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; padding-top: 100px;">
  <div class="container">
    <div class="glass-card" style="max-width: 500px; margin: 0 auto;">
      <div class="text-center mb-4">
        <h2 style="color: var(--color-accent); font-size: 2rem; margin-bottom: 10px;">Daftar Akun</h2>
        <p class="text-text-muted">Buat akun untuk dapat mengajukan layanan di portal Sandikami.</p>
      </div>
      
      @if($errors->any())
        <div style="background-color: var(--color-danger, #e74c3c); color: white; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label" for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-4">
          <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-accent btn-block" style="padding: 15px; font-size: 1.1rem; margin-top: 10px;">
            <i class="ri-user-add-line mr-2"></i> Daftar Sekarang
        </button>
        
        <div class="text-center mt-4">
            <p class="text-text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
