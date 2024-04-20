<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Add the sanctum middleware to ensure CSRF protection
        $response = $next($request);

        // Ensure the SPA (Single Page Application) frontend sends the proper CORS headers
        $response->headers->set('Access-Control-Allow-Origin', config('app.frontend_url'));
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
