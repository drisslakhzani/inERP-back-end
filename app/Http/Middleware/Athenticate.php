<?php

// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Athenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('authenticated')) {
            return redirect('/login');
        }

        return $next($request);
    }
}

