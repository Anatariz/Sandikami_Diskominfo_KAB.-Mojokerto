<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class LoginThrottleTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_is_locked_out_after_three_failed_attempts(): void
    {
        $email = 'admin@mojokertokab.go.id';
        $ip = '127.0.0.1';
        $throttleKey = \Illuminate\Support\Str::transliterate(\Illuminate\Support\Str::lower($email) . '|' . $ip);
        RateLimiter::clear($throttleKey);

        // Attempt 1
        $res1 = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => 'wrong-pass-1',
        ]);
        $res1->assertRedirect('/login');
        $res1->assertSessionHas('remaining_attempts', 2);
        $res1->assertSessionHas('show_forgot_password_suggestion', true);

        // Attempt 2
        $res2 = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => 'wrong-pass-2',
        ]);
        $res2->assertRedirect('/login');
        $res2->assertSessionHas('remaining_attempts', 1);
        $res2->assertSessionHas('show_forgot_password_suggestion', true);

        // Attempt 3 (Lockout triggered)
        $res3 = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => 'wrong-pass-3',
        ]);
        $res3->assertRedirect('/login');
        $res3->assertSessionHas('lockout', true);
        $res3->assertSessionHas('seconds_remaining');
        $res3->assertSessionHas('show_forgot_password_suggestion', true);

        // Attempt 4 while locked
        $res4 = $this->from('/login')->post('/login', [
            'email' => $email,
            'password' => 'wrong-pass-4',
        ]);
        $res4->assertRedirect('/login');
        $res4->assertSessionHas('lockout', true);

        RateLimiter::clear($throttleKey);
    }

    public function test_forgot_password_page_is_accessible(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
        $response->assertSee('Lupa Password');
    }

    public function test_successful_login_clears_throttle(): void
    {
        $user = User::factory()->create([
            'email' => 'petugas@mojokertokab.go.id',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $throttleKey = \Illuminate\Support\Str::transliterate(\Illuminate\Support\Str::lower($user->email) . '|127.0.0.1');

        // 1 failed attempt
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong',
        ]);
        $this->assertEquals(1, RateLimiter::attempts($throttleKey));

        // Successful attempt clears attempts
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $this->assertEquals(0, RateLimiter::attempts($throttleKey));
    }
}
