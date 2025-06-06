<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class RssFeedsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->getPermission('rss-feeds')) {
            return $next($request);
        }

        if (env('APP_ENV') === 'local' && Auth::check()) {
            return $next($request);
        }

        $currentUrl = URL::full();
        $redirectUrl = Config::get('app.locale') . '/' . __('url.account') . '?return_url=' . urlencode($currentUrl) . '&from=rss-feeds';
        return redirect($redirectUrl);
    }
}
