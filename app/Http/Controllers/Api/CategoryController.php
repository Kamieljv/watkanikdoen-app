<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

class CategoryController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     summary="Get a list of categories",
     *     tags={"Categories"},
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

        $query = Category::query();

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

        $categories = $query->paginate($perPage);

        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return $this->sendError('Category not found', [], 404);
        }

        return $this->sendResponse(
            new CategoryResource($category),
            'Category retrieved successfully'
        );
    }
}
