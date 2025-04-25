<?php

namespace App\Providers;

use App\Http\Middleware\TimetrackingMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class TimetrackingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('timetracking', TimetrackingMiddleware::class);
    }
}
