<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ActieResource;
use App\Models\Actie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActieController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 15);
        $perPage = min($perPage, 100); // Max 100 per page

        $query = Actie::query()
            ->published()
            ->with(['organizers', 'categories', 'themes', 'linked_image']);

        // Filter by upcoming/past
        if ($request->has('upcoming')) {
            $upcoming = filter_var($request->input('upcoming'), FILTER_VALIDATE_BOOLEAN);
            if ($upcoming) {
                $query->nietAfgelopen();
            } else {
                $query->whereRaw("STR_TO_DATE(CONCAT(end_date, ' ', IFNULL(end_time, '23:59:59')), '%Y-%m-%d %H:%i:%s') <= NOW()");
            }
        }

        // Filter by theme
        if ($request->has('theme')) {
            $query->whereHas('themes', function ($q) use ($request) {
                $q->where('themes.slug', $request->input('theme'));
            });
        }

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.slug', $request->input('category'));
            });
        }

        // Filter by organizer
        if ($request->has('organizer')) {
            $query->whereHas('organizers', function ($q) use ($request) {
                $q->where('organizers.slug', $request->input('organizer'));
            });
        }

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'start_date');
        $sortOrder = $request->input('sort_order', 'asc');
        
        if (in_array($sortBy, ['start_date', 'created_at', 'title', 'pageviews'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $acties = $query->paginate($perPage);

        return ActieResource::collection($acties);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        $actie = Actie::query()
            ->where('slug', $slug)
            ->published()
            ->with(['organizers', 'categories', 'themes', 'linked_image'])
            ->first();

        if (!$actie) {
            return $this->sendError('Actie not found', [], 404);
        }

        return $this->sendResponse(
            new ActieResource($actie),
            'Actie retrieved successfully'
        );
    }
}
