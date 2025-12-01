<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ThemeController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 50);
        $perPage = min($perPage, 100); // Max 100 per page

        $query = Theme::query();

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');
        
        if (in_array($sortBy, ['name', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $themes = $query->paginate($perPage);

        return ThemeResource::collection($themes);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        $theme = Theme::where('slug', $slug)->first();

        if (!$theme) {
            return $this->sendError('Theme not found', [], 404);
        }

        return $this->sendResponse(
            new ThemeResource($theme),
            'Theme retrieved successfully'
        );
    }
}
