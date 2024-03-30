<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Athenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('admin.login');

        if ($request->expectsJson()) {
            return null;
        }
        
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        return route('users.login');
    }
}
