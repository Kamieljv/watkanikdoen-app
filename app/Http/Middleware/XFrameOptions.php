<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

use Closure;

class XFrameOptions
{
    /**
     * Handle the given request and get the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);


        // Remove X-Frame-Options for all route whitelisted in config
        if (in_array($request->route()->uri(), config('app.xframe_whitelist'))) {
            $response->headers->set('X-Frame-Options', '', true);
        } else {
            // set SAMEORIGIN for all other routes
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN', false);
        }

        return $response;
    }
}