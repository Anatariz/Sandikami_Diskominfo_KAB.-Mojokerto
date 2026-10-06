<?php

namespace App\Http\Controllers;

use App\Helpers\CaptchaHelper;
use Illuminate\Http\JsonResponse;

class CaptchaController extends Controller
{
    /**
     * Endpoint API untuk me-refresh captcha dinamis via AJAX.
     */
    public function refresh(): JsonResponse
    {
        return response()->json(CaptchaHelper::generate());
    }
}
