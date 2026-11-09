<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StorePreviousUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Store the current URL in the session
        if ($request->isMethod('get')) {
            session(['previous_url' => url()->current()]);
        }

        return $next($request);
    }
}
