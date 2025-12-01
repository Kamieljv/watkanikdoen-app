<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

class ThemeController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/themes",
     *     summary="Get a list of themes",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (max 100)",
     *         required=false,
     *         @OA\Schema(type="integer", default=50)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
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
     * @OA\Get(
     *     path="/themes/{slug}",
     *     summary="Get a specific theme",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Theme slug",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Theme not found"
     *     )
     * )
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
