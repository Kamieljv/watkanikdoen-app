<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index(Request $request)
    {
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
            $coordinates = explode(',', $request->coordinates);
            $radius = ($request->distance ?? 9999) * 1000;
            $query->whereRaw("ST_Distance_Sphere(location, ST_GeomFromText('POINT({$coordinates[1]} {$coordinates[0]})')) <= {$radius}");
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
