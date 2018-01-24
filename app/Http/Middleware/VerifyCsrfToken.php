<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/panel/upload-image',
        '/88905215:AAHwtR-_cZd16tcSn_-kKmP8kpM8L-Pik6o/webhook',
    ];
}
