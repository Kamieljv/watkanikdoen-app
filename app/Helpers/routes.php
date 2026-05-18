<?php

use Illuminate\Support\Facades\Route;

/**
 * Get route URIs matching a name pattern (string prefix or regex) and/or a URI regex.
 * The name is the name of the route, not the URI. For example, for a route defined as 
 * Route::get('/acties/search', [ActieController::class, 'search'])->name('acties.search'), 
 * the name is 'acties.search' and the URI is '/acties/search'.
 *
 * @param  string|null  $namePattern   Exact prefix or regex (e.g. 'book' or '/^book\./')
 * @param  bool|null    $includeAdminRoutes    Whether to include admin routes (default: false)
 * @return array<string, string>       Associative array of [name => uri]
 */
function getRouteUris(string $namePattern, ?bool $includeAdminRoutes = false): array
{
    return collect(Route::getRoutes()->getRoutesByName())
        ->when($namePattern, function ($routes, $pattern) {
            $isRegex = @preg_match($pattern, '') !== false && str_starts_with($pattern, '/');
            return $routes->filter(fn ($route, $name) =>
                $isRegex ? (bool) preg_match($pattern, $name) : str_contains($name, $pattern)
            );
        })
        ->when(!$includeAdminRoutes, function ($routes) {
            return $routes->filter(fn ($route) => strpos($route->uri, 'admin') === false);
        })
        ->mapWithKeys(fn ($route, $name) => [$name => '/' . $route->uri])
        ->all();
}
