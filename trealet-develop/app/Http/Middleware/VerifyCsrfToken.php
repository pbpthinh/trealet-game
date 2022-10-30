<?php

namespace Vanguard\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'v2/input/play/data',
        'v2/registerUser',
        'v2/uploadVideo',
        'v2/uploadImage',
        'v2/uploadAudio',
        'map-player/login',
        'map-player/maps',
        'map-player/map-detail',
        'map-player/register',
        'map-player/upload',
        'map-player/save-input',
        'map-player/get-input',
        'map-player/social-login'
	//
    ];
}