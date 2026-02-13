<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ActieResource;
use App\Models\Actie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

class ActieController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/acties",
     *     summary="Get a list of acties",
     *     tags={"Acties"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (max 100)",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Parameter(
     *         name="upcoming",
     *         in="query",
     *         description="Filter by upcoming (true) or past (false) acties",
     *         required=false,
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Parameter(
     *         name="theme",
     *         in="query",
     *         description="Filter by theme slug",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Filter by category slug",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="organizer",
     *         in="query",
     *         description="Filter by organizer slug",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sort by field (start_date, created_at, title, pageviews)",
     *         required=false,
     *         @OA\Schema(type="string", default="start_date")
     *     ),
     *     @OA\Parameter(
     *         name="sort_order",
     *         in="query",
     *         description="Sort order (asc or desc)",
     *         required=false,
     *         @OA\Schema(type="string", default="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/ActieResource")
     *                 ),
     *                 @OA\Property(
     *                     property="links",
     *                     type="object"
     *                 ),
     *                 @OA\Property(
     *                     property="meta",
     *                     type="object"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 15);
        $perPage = min($perPage, 100); // Max 100 per page

        $query = Actie::query()
            ->published()
            ->with([
                'organizers' => function ($query) {
                    $query->published();
                },
                'categories',
                'themes',
            ]);

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
                $q->where('organizers.slug', $request->input('organizer'))
                    ->where('organizers.status', 'PUBLISHED');
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
     * @OA\Get(
     *     path="/acties/{slug}",
     *     summary="Get a specific actie",
     *     tags={"Acties"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Actie slug",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     ref="#/components/schemas/ActieResource"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Actie not found"
     *     )
     * )
     */
    public function show(string $slug): JsonResponse
    {
        $actie = Actie::query()
            ->where('slug', $slug)
            ->published()
            ->with([
                'organizers' => function ($query) {
                    $query->published();
                },
                'categories',
                'themes',
            ])
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
