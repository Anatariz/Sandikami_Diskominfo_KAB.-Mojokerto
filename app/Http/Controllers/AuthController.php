<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Autentikasi pengguna dengan batas percobaan (maksimal 3 kali).
     * Jika gagal 3 kali, pengguna akan mendapatkan jeda waktu (cooldown)
     * dan saran untuk menggunakan fitur Lupa Password.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $maxAttempts = 3;       // Maksimal percobaan salah: 3 kali
        $decaySeconds = 60;     // Durasi jeda waktu: 60 detik (1 menit)
        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        // 1. Cek jika pengguna masih dalam masa jeda waktu (terkunci)
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login yang gagal. Akun Anda sementara dibatasi. Silakan tunggu jeda waktu {$seconds} detik sebelum mencoba kembali, atau pilih opsi Lupa Password jika Anda lupa kata sandi.",
            ])->onlyInput('email')
              ->with('lockout', true)
              ->with('seconds_remaining', $seconds)
              ->with('show_forgot_password_suggestion', true);
        }

        // 2. Percobaan autentikasi dengan kredensial yang dimasukkan
        if (Auth::attempt($credentials)) {
            // Login berhasil, bersihkan riwayat percobaan yang gagal
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();
            if (auth()->user()->role === 'admin') {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/');
        }

        // 3. Autentikasi gagal, catat percobaan salah
        RateLimiter::hit($throttleKey, $decaySeconds);

        // Jika setelah percobaan ini batas 3 kali terpenuhi
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => "Email atau password salah. Anda telah salah memasukkan data sebanyak {$maxAttempts} kali. Akun Anda dibatasi sementara selama {$seconds} detik. Silakan gunakan opsi Lupa Password di bawah jika Anda tidak mengingat kata sandi.",
            ])->onlyInput('email')
              ->with('lockout', true)
              ->with('seconds_remaining', $seconds)
              ->with('show_forgot_password_suggestion', true);
        }

        // Jika belum mencapai 3 kali, hitung sisa kesempatan
        $remainingAttempts = RateLimiter::remaining($throttleKey, $maxAttempts);

        return back()->withErrors([
            'email' => "Email atau password salah. Sisa kesempatan mencoba: {$remainingAttempts} kali lagi. Jika Anda lupa kata sandi, disarankan untuk memilih opsi Lupa Password.",
        ])->onlyInput('email')
          ->with('remaining_attempts', $remainingAttempts)
          ->with('show_forgot_password_suggestion', true);
    }

    /**
     * Tampilkan formulir permintaan reset password (Lupa Password).
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim link reset password ke email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)])->onlyInput('email');
    }

    /**
     * Tampilkan formulir reset password dengan token.
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Proses pembaruan password setelah reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Bersihkan batasan percobaan login untuk akun ini
            $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
            RateLimiter::clear($throttleKey);

            return redirect()->route('login')->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan login menggunakan kata sandi baru.');
        }

        return back()->withErrors(['email' => __($status)])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'divisi' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'divisi' => $request->divisi,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
