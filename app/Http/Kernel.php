<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class, // Ini biasanya uncommented kalau Anda butuh
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [ // Pastikan ini deklarasi yang benar, tanpa 'array' setelah 'protected'
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // Umumnya uncommented
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Umumnya uncommented
            \Illuminate\Session\Middleware\StartSession::class, // Umumnya uncommented
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Umumnya uncommented
            \App\Http\Middleware\VerifyCsrfToken::class, // Umumnya uncommented
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Umumnya uncommented
            \App\Http\Middleware\SetLocale::class, // Middleware bahasa Anda
            \App\Http\Middleware\SetTheme::class,  // Middleware tema Anda
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    // Jika Anda memiliki $routeMiddleware, pastikan ada di sini juga.
    // protected $routeMiddleware = [
    //    'auth' => \App\Http\Middleware\Authenticate::class,
    //    // ...
    // ];
}