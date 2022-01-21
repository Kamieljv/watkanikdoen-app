<?php

namespace Wave\Http\Middleware;

use Closure;

class Cancelled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role->name === 'cancelled') {
            return redirect()->route('cancelled');
        }

        return $next($request);
    }
}
