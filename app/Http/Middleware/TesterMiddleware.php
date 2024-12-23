<?php

namespace App\Http\Middleware;

use App\Utilities\FingerprintUtility;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utilities\SessionUtility;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class TesterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (SessionUtility::testerAuthenticated()) {
            return $next($request);
        }

        $currentUrl = URL::full(); // Get the current full URL
        $redirectUrl =
            Config::get("app.locale") .
            "/tester/auth?return_url=" .
            urlencode($currentUrl); // Append the current URL as a return_url parameter

        return redirect($redirectUrl);
    }
}
