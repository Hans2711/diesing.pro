<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utilities\MinifyHtml;
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
        MinifyHtml::enable();

        $response = $next($request);

        if (! MinifyHtml::isEnabled()) {
            return $response;
        }

        $type = $response->headers->get('Content-Type');
        if ($type && str_contains($type, 'text/html')) {
            $html = $response->getContent();
            $parts = preg_split('/(<pre.*?<\/pre>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
            foreach ($parts as $i => $part) {
                if (! preg_match('/^<pre/i', $part)) {
                    $part = preg_replace('/>\s+</', '><', $part);
                    $part = preg_replace('/\s{2,}/', ' ', $part);
                    $parts[$i] = $part;
                }
            }
            $response->setContent(implode('', $parts));
        }

        return $response;
    }
}
