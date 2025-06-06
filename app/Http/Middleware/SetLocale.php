<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = 'en';

        $acceptLanguage = $request->server('HTTP_ACCEPT_LANGUAGE');
        if ($acceptLanguage !== null) {
            $browserLocales = explode(',', $acceptLanguage);
            foreach ($browserLocales as $browserLocale) {
                $langPrefix = substr($browserLocale, 0, 2);
                if (in_array($langPrefix, ['de', 'en'])) {
                    $locale = $langPrefix;
                    break;
                }
            }
        }

        if ($request->segment(1) === 'de') {
            $locale = 'de';
        } elseif ($request->segment(1) === 'en') {
            $locale = 'en';
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
