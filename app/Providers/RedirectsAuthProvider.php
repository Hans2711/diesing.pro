<?php

namespace App\Providers;

use App\Http\Middleware\RedirectsMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RedirectsAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware("redirects", RedirectsMiddleware::class);
    }
}
