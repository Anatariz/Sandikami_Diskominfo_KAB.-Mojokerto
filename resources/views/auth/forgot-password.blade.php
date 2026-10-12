@extends('layouts.app')

@section('title', 'Lupa Password | Sandikami')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; padding-top: 100px; padding-bottom: 60px;">
  <div class="container">
    <div class="glass-card" style="max-width: 480px; margin: 0 auto;">
      <div class="text-center mb-4">
        <div style="width: 65px; height: 65px; border-radius: 50%; background: #e0effe; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; border: 1.5px solid #bfdbfe;">
          <i class="ri-key-2-line" style="font-size: 2rem; color: var(--color-primary);"></i>
        </div>
        <h2 style="color: var(--color-primary); font-size: 2rem; margin-bottom: 10px;">Lupa Password</h2>
        <p class="text-text-muted" style="font-size: 0.95rem;">
          Masukkan alamat email yang terdaftar pada akun Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
        </p>
      </div>

      @if(session('status'))
        <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="ri-checkbox-circle-fill" style="font-size: 1.5rem; color: #059669; flex-shrink: 0;"></i>
            <div>{{ session('status') }}</div>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
          <label class="form-label" for="email">Alamat Email Terdaftar</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@instansi.go.id">
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="padding: 15px; font-size: 1.1rem; margin-top: 10px;">
          <i class="ri-mail-send-line mr-2"></i> Kirim Tautan Reset Password
        </button>

        <div class="text-center mt-4" style="border-top: 1px solid var(--glass-border); padding-top: 20px;">
          <p class="text-text-muted" style="margin-bottom: 10px; font-size: 0.9rem;">Sudah ingat kata sandi Anda?</p>
          <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 8px 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px;">
            <i class="ri-arrow-left-line"></i> Kembali ke Halaman Login
          </a>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
