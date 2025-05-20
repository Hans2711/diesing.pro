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
        $segment = $request->segment(1);
        $available = array_values(config('app.available_locales'));

        if (in_array($segment, $available)) {
            App::setLocale($segment);
            Carbon::setLocale($segment);
        } else {
            App::setLocale('en');
            Carbon::setLocale('en');
        }

        return $next($request);
    }
}
