<?php

namespace App\Providers;

use App\Http\Middleware\PortfolioMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PortfolioAuthProvider extends ServiceProvider
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
        Route::aliasMiddleware("portfolio", PortfolioMiddleware::class);
    }
}
