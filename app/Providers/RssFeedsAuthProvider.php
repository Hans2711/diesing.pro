<?php

namespace App\Providers;

use App\Http\Middleware\RssFeedsMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RssFeedsAuthProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::aliasMiddleware('rss-feeds', RssFeedsMiddleware::class);
    }
}
