@extends('layouts.app')

@section('title', 'Atur Ulang Password | Sandikami')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; padding-top: 100px; padding-bottom: 60px;">
  <div class="container">
    <div class="glass-card" style="max-width: 480px; margin: 0 auto;">
      <div class="text-center mb-4">
        <div style="width: 65px; height: 65px; border-radius: 50%; background: #e0effe; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; border: 1.5px solid #bfdbfe;">
          <i class="ri-shield-keyhole-line" style="font-size: 2rem; color: var(--color-primary);"></i>
        </div>
        <h2 style="color: var(--color-primary); font-size: 2rem; margin-bottom: 10px;">Atur Ulang Password</h2>
        <p class="text-text-muted" style="font-size: 0.95rem;">
          Buat kata sandi baru untuk akun Anda.
        </p>
      </div>

      @if($errors->any())
        <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group mb-3">
          <label class="form-label" for="email">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $email) }}" required readonly style="background-color: #f1f5f9; color: #64748b; cursor: not-allowed;">
        </div>

        <div class="form-group mb-3">
          <label class="form-label" for="password">Password Baru</label>
          <input type="password" id="password" name="password" class="form-control" required autofocus placeholder="Minimal 8 karakter">
        </div>

        <div class="form-group mb-4">
          <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Ulangi kata sandi baru">
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="padding: 15px; font-size: 1.1rem; margin-top: 10px;">
          <i class="ri-check-line mr-2"></i> Perbarui Kata Sandi
        </button>

        <div class="text-center mt-4">
          <a href="{{ route('login') }}" class="text-primary" style="font-size: 0.95rem;">
            <i class="ri-arrow-left-line"></i> Kembali ke Halaman Login
          </a>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
