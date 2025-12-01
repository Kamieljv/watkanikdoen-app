<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrganizerResource;
use App\Models\Organizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

class OrganizerController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/organizers",
     *     summary="Get a list of organizers",
     *     tags={"Organizers"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (max 100)",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
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
        $perPage = $request->input('per_page', 15);
        $perPage = min($perPage, 100); // Max 100 per page

        $query = Organizer::query();

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');
        
        if (in_array($sortBy, ['name', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $organizers = $query->paginate($perPage);

        return OrganizerResource::collection($organizers);
    }

    /**
     * @OA\Get(
     *     path="/organizers/{slug}",
     *     summary="Get a specific organizer",
     *     tags={"Organizers"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Organizer slug",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Organizer not found"
     *     )
     * )
     */
    public function show(string $slug): JsonResponse
    {
        $organizer = Organizer::where('slug', $slug)->first();

        if (!$organizer) {
            return $this->sendError('Organizer not found', [], 404);
        }

        return $this->sendResponse(
            new OrganizerResource($organizer),
            'Organizer retrieved successfully'
        );
    }
}
