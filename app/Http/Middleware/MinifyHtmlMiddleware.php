<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinifyHtmlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (env("APP_MINIFY_HTML")) {
            $response = $next($request);
            $response->setContent($this->minifyHtml($response->getContent()));
            return $response;
        } else {
            return $next($request);
        }
    }

    public function minifyHtml(string $html): string
    {
        return $html;
    }
}
