<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Models\Theme;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Voyager;


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
        SEOTools::setTitle(__("organizers.title"));
        SEOTools::setDescription(__("organizers.description"));

        return view('organizers.index', compact('routes', 'themes'));
    }

    public function search(Request $request)
    {
        $query = Organizer::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->q . '%');
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
            $organizers = $query->orderBy('name', 'ASC')->published()->paginate(12);
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
        SEOTools::setTitle($organizer->name);
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

    public function approve($id)
    {
        $dataTypeOrganizers = Voyager::model('DataType')->where('slug', '=', 'organizers')->first();

        // Check permissions
        $this->authorize('edit', app($dataTypeOrganizers->model_name));

        // get report data
        $organizer = Organizer::findOrFail($id);

        // check if status is actually pending
        if ($organizer->status !== 'PENDING') {
            return back()
            ->with([
                'message'    => __('general.approve_fail', ['entity' => 'Organisator']),
                'alert-type' => 'error',
            ]);
        }

        // check if user who submitted this action is verified
        $user = User::findOrFail($organizer->user_id);
        if (!$user->verified === 1) {
            return back()
            ->with([
                'message'    => __('general.approve_fail_user_not_verified', ['entity' => 'Organisator']),
                'alert-type' => 'error',
            ]);
        }

        // change organizer status
        $organizer->approve();

        return redirect()
            ->route("voyager.organizers.index")
            ->with([
                'message'    => __('general.approve_success', ['entity' => 'Organisator']),
                'alert-type' => 'success',
            ]);
    }

    public function publish($id)
    {
        $dataTypeOrganizers = Voyager::model('DataType')->where('slug', '=', 'organizers')->first();

        // Check permissions
        $this->authorize('edit', app($dataTypeOrganizers->model_name));

        // get report data
        $organizer = Organizer::findOrFail($id);

        // check if status is actually approved
        if ($organizer->status !== 'APPROVED') {
            return back()
            ->with([
                'message'    => __('general.publish_fail', ['entity' => 'Organisator']),
                'alert-type' => 'error',
            ]);
        }

        // change organizer status
        $organizer->publish();

        return redirect()
            ->route("voyager.organizers.index")
            ->with([
                'message'    => __('general.publish_success', ['entity' => 'Organisator']),
                'alert-type' => 'success',
            ]);
    }
}
