@extends('layouts.app')

@section('title', 'Masuk | Sandikami')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; padding-top: 100px; padding-bottom: 60px;">
  <div class="container">
    <div class="glass-card" style="max-width: 480px; margin: 0 auto;">
      <div class="text-center mb-4">
        <h2 style="color: var(--color-accent); font-size: 2rem; margin-bottom: 10px;">Welcome to SandiKami</h2>
        <p class="text-text-muted">Masuk ke portal SandiKami Kab. Mojokerto</p>
      </div>
      
      {{-- Notifikasi Sukses --}}
      @if(session('success'))
        <div style="background-color: rgba(16, 185, 129, 0.2); border: 1px solid var(--color-success); color: white; padding: 14px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
          <i class="ri-checkbox-circle-fill" style="color: var(--color-success); font-size: 1.4rem; flex-shrink: 0;"></i>
          <div>{{ session('success') }}</div>
        </div>
      @endif

      {{-- Notifikasi Terkunci (Lockout setelah 3 kali gagal) --}}
      @if(session('lockout'))
        <div style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid var(--color-danger); color: white; padding: 18px; border-radius: 10px; margin-bottom: 22px;">
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
            <i class="ri-alarm-warning-fill" style="color: var(--color-danger); font-size: 1.5rem; flex-shrink: 0;"></i>
            <strong style="font-size: 1.05rem; color: #fff;">Percobaan Gagal (Maksimal 3 Kali)</strong>
          </div>
          <p style="font-size: 0.92rem; color: var(--color-text); margin-bottom: 12px; line-height: 1.5;">
            {{ $errors->first('email') ?? 'Anda telah salah memasukkan email atau kata sandi sebanyak 3 kali.' }}
          </p>

          {{-- Kotak Timer Jeda Waktu --}}
          <div id="cooldown-box" style="background: rgba(0, 0, 0, 0.35); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 8px; padding: 10px 14px; text-align: center; margin-bottom: 14px;">
            <i class="ri-time-line" style="color: var(--color-accent); font-size: 1.2rem; vertical-align: middle; margin-right: 4px;"></i>
            <span>Jeda waktu: <strong id="countdown" style="color: var(--color-accent); font-size: 1.25rem;">{{ session('seconds_remaining', 60) }}</strong> detik sebelum dapat mencoba lagi.</span>
          </div>

          {{-- Kotak Saran Memilih Lupa Password --}}
          <div style="background: rgba(0, 168, 232, 0.12); border-left: 4px solid var(--color-secondary); padding: 12px 14px; border-radius: 6px;">
            <div style="font-weight: 600; color: #fff; display: flex; align-items: center; gap: 6px; margin-bottom: 5px;">
              <i class="ri-lightbulb-fill" style="color: var(--color-accent); font-size: 1.1rem;"></i>
              <span>Saran: Gunakan Fitur Lupa Password</span>
            </div>
            <p style="font-size: 0.88rem; color: var(--color-text-muted); margin-bottom: 10px; line-height: 1.4;">
              Jika Anda tidak mengingat kata sandi Anda, jangan terus mencoba. Anda disarankan untuk melakukan reset kata sandi agar akun tidak terkunci kembali.
            </p>
            <a href="{{ route('password.request') }}" class="btn btn-outline" style="font-size: 0.88rem; padding: 7px 16px; display: inline-flex; align-items: center; gap: 6px; border-color: var(--color-secondary); color: var(--color-secondary); background: rgba(0, 168, 232, 0.1);">
              <i class="ri-key-2-line"></i> Pilih Lupa Password Sekarang
            </a>
          </div>
        </div>
      @elseif($errors->any())
        {{-- Notifikasi Error Biasa (Sebelum Terkunci 3 Kali) --}}
        <div style="background-color: var(--color-danger, #e74c3c); color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>

          @if(session('show_forgot_password_suggestion'))
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 0.9rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
              <span><i class="ri-information-line"></i> Lupa kata sandi Anda?</span>
              <a href="{{ route('password.request') }}" style="color: var(--color-accent); font-weight: 600; text-decoration: underline;">
                Pilih Lupa Password di sini &rarr;
              </a>
            </div>
          @endif
        </div>
      @endif

      <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
          <label class="form-label" for="email">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@mojokertokab.go.id">
        </div>
        
        <div class="form-group mb-4">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
            <label class="form-label" for="password" style="margin-bottom: 0;">Password</label>
            <a href="{{ route('password.request') }}" style="font-size: 0.85rem; color: var(--color-secondary); text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 4px;" title="Reset kata sandi jika Anda lupa">
              <i class="ri-question-line"></i> Lupa Password?
            </a>
          </div>
          <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        
        <button type="submit" id="login-submit-btn" class="btn btn-accent btn-block" style="padding: 15px; font-size: 1.1rem; margin-top: 10px;">
          <i class="ri-login-circle-line mr-2"></i> Masuk
        </button>
        
        <div class="text-center mt-4">
          <p class="text-text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar di sini</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    @if(session('lockout'))
      let seconds = {{ (int) session('seconds_remaining', 60) }};
      const countdownEl = document.getElementById('countdown');
      const submitBtn = document.getElementById('login-submit-btn');
      const cooldownBox = document.getElementById('cooldown-box');

      if (seconds > 0 && countdownEl && submitBtn) {
        // Nonaktifkan tombol login selama masa jeda
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.6';
        submitBtn.style.cursor = 'not-allowed';
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="ri-time-line mr-2"></i> Menunggu Jeda (' + seconds + 's)';

        const timer = setInterval(function () {
          seconds--;
          if (countdownEl) {
            countdownEl.textContent = seconds;
          }
          submitBtn.innerHTML = '<i class="ri-time-line mr-2"></i> Menunggu Jeda (' + seconds + 's)';

          if (seconds <= 0) {
            clearInterval(timer);
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = originalBtnHtml;

            if (cooldownBox) {
              cooldownBox.style.borderColor = 'var(--color-success)';
              cooldownBox.style.backgroundColor = 'rgba(16, 185, 129, 0.15)';
              cooldownBox.innerHTML = '<i class="ri-checkbox-circle-fill" style="color: var(--color-success); font-size: 1.2rem; vertical-align: middle; margin-right: 4px;"></i> <strong style="color: var(--color-success);">Jeda waktu selesai!</strong> Anda dapat mencoba masuk kembali.';
            }
          }
        }, 1000);
      }
    @endif
  });
</script>
@endpush
