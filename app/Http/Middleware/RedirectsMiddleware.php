<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utilities\SessionUtility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class RedirectsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->getPermission("redirects")) {
            return $next($request);
        }

        if (env('APP_ENV') === 'local' && Auth::check()) {
            return $next($request);
        }

        $currentUrl = URL::full();
        $redirectUrl =
            Config::get("app.locale") .
            "/" .
            __("url.account") .
            "?return_url=" .
            urlencode($currentUrl) .
            "&from=redirects";

        return redirect($redirectUrl);
    }
}
