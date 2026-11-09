<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
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
        // Check if maintenance mode is enabled
        if (config('app.maintenance_mode')) {
            // Allow access if user is authenticated and has admin role
            if (Auth::check() && Auth::user()->hasRole('admin')) {
                return $next($request);
            }

            // Allow access to login/logout and admin routes
            if ($request->is('login') || $request->is('logout') || $request->is('admin/*')) {
                return $next($request);
            }

            // Don't redirect if already on the maintenance page
            if ($request->is('maintenance')) {
                return $next($request);
            }

            // Redirect all other traffic to maintenance page
            return redirect()->route('maintenance');
        }

        return $next($request);
    }
}
