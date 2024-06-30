<?php

namespace App\Http\Middleware;

use App\Utilities\SessionUtility;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        }

        return redirect('/privater-bereich');
    }
}
