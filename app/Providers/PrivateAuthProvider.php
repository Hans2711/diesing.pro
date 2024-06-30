<?php

namespace App\Providers;

use App\Http\Middleware\PrivateMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PrivateAuthProvider extends ServiceProvider
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
        //
        Route::aliasMiddleware('private', PrivateMiddleware::class);
    }
}
