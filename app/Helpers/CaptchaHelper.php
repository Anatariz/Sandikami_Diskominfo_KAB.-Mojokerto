<?php

namespace App\Helpers;

class CaptchaHelper
{
    /**
     * Karakter yang digunakan untuk captcha (menghindari karakter ambigu seperti 0, O, 1, I).
     */
    protected static string $charset = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';

    /**
     * Panjang karakter captcha.
     */
    protected static int $length = 5;

    /**
     * Generate captcha baru dengan kode, tampilan berspasi, dan HMAC hash.
     */
    public static function generate(): array
    {
        $characters = self::$charset;
        $charLength = strlen($characters);
        $code = '';

        for ($i = 0; $i < self::$length; $i++) {
            $code .= $characters[random_int(0, $charLength - 1)];
        }

        $appKey = (string) config('app.key', 'default_secret_sandikami_key');
        $hash = hash_hmac('sha256', $code, $appKey);

        return [
            'code' => $code,
            'display' => implode(' ', str_split($code)),
            'hash' => $hash,
        ];
    }

    /**
     * Verifikasi jawaban captcha dari user terhadap hash yang diberikan.
     */
    public static function verify(?string $userInput, ?string $hash): bool
    {
        if (empty($userInput) || empty($hash)) {
            return false;
        }

        $sanitizedInput = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $userInput));
        $appKey = (string) config('app.key', 'default_secret_sandikami_key');
        $expectedHash = hash_hmac('sha256', $sanitizedInput, $appKey);

        return hash_equals($expectedHash, $hash);
    }
}
