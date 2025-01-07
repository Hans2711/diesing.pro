<?php

namespace App\Http\Middleware;

use App\Utilities\SessionUtility;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
use App\Utilities\FingerprintUtility;
use Illuminate\Support\Facades\App;

class PrivateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (SessionUtility::privateAreaAuthenticated()) {
            return $next($request);
        } else {
            if (FingerprintUtility::checkFingerprint("asd")) {
                SessionUtility::testerAuthenticated();
                return $next($request);
            }
        }

        $currentUrl = URL::full(); // Get the current full URL
        $redirectUrl =
            App::getLocale() .
            "/" .
            __("url.private-area") .
            "?return_url=" .
            urlencode($currentUrl);

        return redirect($redirectUrl);
    }
}
