<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Status;
use App\Models\Theme;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class OrganizerController extends Controller
{
    public function index()
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'organisatoren') !== false || strpos($route->uri, 'organisator') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        $themes = Theme::orderBy('name', 'ASC')->get();

        // SEO
        SEOTools::setTitle(__("organizers.title") . ' | ' . config('brand.title'));
        SEOTools::setDescription(__("organizers.description"));

        return view('organizers.index', compact('routes', 'themes'));
    }

    public function search(Request $request)
    {
        $query = Organizer::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->q . '%');
            });
        }
        if ($request->themes) {
            $requestThemes = $request->themes;
            $query->whereHas('themes', function ($q) use ($requestThemes) {
                $q->whereIn('theme_id', $requestThemes);
            });
        }
        if ($request->onlyFeatured) {
            if ($request->onlyFeatured === 'true') {
                $query->where('featured', 1);
            }
        }
        if ($request->limit) {
            $organizers = $query->orderBy('name', 'ASC')->published()->limit($request->limit)->get();
        } else {
            $organizers = $query->orderBy('name', 'ASC')->published()->paginate(24);
        }

        return response()->json(['organizers' => $organizers]);
    }

    public function organizer($slug)
    {

        $organizer = Organizer::where('slug', '=', $slug)->firstOrFail();

        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = collect(Route::getRoutes()->getRoutesByName())->filter(function ($route) {
            return (strpos($route->uri, 'acties') !== false) && (strpos($route->uri, 'admin') === false);
        })->map(function ($route) {
            return [
                'uri' => '/' . $route->uri,
                'methods' => $route->methods,
            ];
        });

        // SEO
        SEOTools::setTitle($organizer->name . ' | ' . config('brand.title'));
        if ($organizer->description !== null) {
            SEOTools::setDescription(substr(strip_tags($organizer->description), 0, 300));
        }

        // Pass admin attribute
        $isAdmin = false;
        if (auth()->user()) {
            $isAdmin = auth()->user()->hasRole('admin');
        }

        return view('organizers.organizer', compact('organizer', 'routes', 'isAdmin'));
    }

    public function approve($id): RedirectResponse
    {
        // Check permissions
        auth()->user()->can('edit_organizers');

        // get report data
        $organizer = Organizer::findOrFail($id);

        // check if status is actually pending
        if ($organizer->status !== Status::PENDING->name) {
            Notification::make()
                ->title(__('general.approve_fail', ['entity' => 'Organisator']))
                ->danger()
                ->send();
            return back();
        }

        // change organizer status
        $organizer->approve();

        Notification::make()
            ->title(__('general.approve_success', ['entity' => 'Organisator']))
            ->success()
            ->send();

        return redirect()
            ->route("filament.admin.resources.organizers.index");
    }
}
