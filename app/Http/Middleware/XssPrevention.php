<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XssPrevention
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get all inputs from request, if any
        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            // strip all tags, except allowed ones
            $input = strip_tags($input, ['a', 'strong', 'li', 'ul', 'ol', 'u', 'i', 'h1', 'h2', 'h3', 'em', 'p', 'br']);
        });

        $request->merge($input);
        return $next($request);
    }
}
