<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            // "lat,lng", e.g. "52.37,4.89"
            'coordinates' => ['nullable', 'regex:/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/'],
        ]);

        $query = Actie::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->q . '%');
            });
        }
        if ($request->keywords) {
            foreach (explode(',', $request->keywords) as $kw) {
                $query->where(function ($q) use ($kw) {
                    $q->where('keywords', 'LIKE', '%' . $kw . '%');
                });
            }
        }
        if ($request->themes) {
            $requestThemes = is_array($request->themes) ? $request->themes : array($request->themes);
            $query->whereHas('themes', function ($q) use ($requestThemes) {
                $q->whereIn('theme_id', $requestThemes);
            });
        }
        if ($request->categories) {
            $requestCategories = is_array($request->categories) ? $request->categories : array($request->categories);
            $query->whereHas('categories', function ($q) use ($requestCategories) {
                $q->whereIn('category_id', $requestCategories);
            });
        }
        if ($request->organizer) {
            $requestOrganizer = is_array($request->organizer) ? $request->organizer : array($request->organizer);
            $query->whereHas('organizers', function ($q) use ($requestOrganizer) {
                $q->whereIn('organizer_id', $requestOrganizer);
            });
        }
        if ($request->coordinates) {
            [$lat, $lng] = array_map('floatval', explode(',', $request->coordinates));
            $radius = ($request->distance ?? 9999) * 1000;
            $distanceSql = "ST_Distance_Sphere(location, ST_GeomFromText(?))";
            $point = "POINT({$lng} {$lat})";
            $query->whereRaw("{$distanceSql} <= ?", [$point, $radius]);
            // closest first when filtering on distance
            $query->orderByRaw("{$distanceSql} ASC", [$point]);
        }

        $query->published()->orderBy('start_date')->orderBy('start_time');

        if ($request->show_past === 'false') {
            $query->nietAfgelopen();
        }

        if ($request->limit) {
            $acties = $query->limit($request->limit)->get();
        } else {
            $acties = $query->limit(50)->get();
        }

        return view('widget', compact('acties'));
    }
}
