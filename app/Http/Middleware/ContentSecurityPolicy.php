<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        // Example CSP header allowing mixed content for demonstration:
        $csp = "default-src 'self' https:; "
             . "connect-src 'self' wss://rt-share.diesing.pro http://rt-share.diesing.pro; "
             . "upgrade-insecure-requests;";
        $response->headers->set('Content-Security-Policy', $csp);
        return $response;
    }
}
