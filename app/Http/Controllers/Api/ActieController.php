<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ActieResource;
use App\Models\Actie;
use Carbon\Carbon;
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
     *     path="/acties/map",
     *     summary="Get minimal map data (id, slug, coordinates, theme colors) for all acties with a location",
     *     tags={"Acties"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function map(): JsonResponse
    {
        $acties = Actie::query()
            ->published()
            ->whereNotNull('location')
            ->without(['organizers', 'categories'])
            ->with('themes:id,color')
            ->select('acties.id', 'acties.slug', 'acties.location')
            ->get()
            ->map(fn (Actie $actie) => [
                'id' => $actie->id,
                'slug' => $actie->slug,
                'lat' => $actie->location->latitude,
                'lng' => $actie->location->longitude,
                'colors' => $actie->themes->pluck('color')->filter()->values(),
            ]);

        return response()->json(['data' => $acties])
            ->header('Cache-Control', 'public, max-age=300');
    }

    /**
     * Date-only label; a range ("15 Dec - 17 Dec 2025") when the actie spans multiple days.
     */
    private function dateRange(Actie $actie): string
    {
        $start = Carbon::parse($actie->start_date);
        $end = $actie->end_date ? Carbon::parse($actie->end_date) : null;

        if (!$end || $end->isSameDay($start)) {
            return $start->translatedFormat('j M Y');
        }

        $startFormat = $start->year === $end->year ? 'j M' : 'j M Y';

        return $start->translatedFormat($startFormat) . ' - ' . $end->translatedFormat('j M Y');
    }

    /**
     * @OA\Get(
     *     path="/acties/{slug}/card",
     *     summary="Get the subset of actie data needed to render an actie card",
     *     tags={"Acties"},
     *     @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Actie not found")
     * )
     */
    public function card(string $slug): JsonResponse
    {
        $actie = Actie::query()
            ->where('slug', $slug)
            ->published()
            ->first();

        if (!$actie) {
            return $this->sendError('Actie not found', [], 404);
        }

        return response()->json(['data' => [
            'id' => $actie->id,
            'title' => $actie->title,
            'link' => $actie->link,
            'start_date' => $this->dateRange($actie),
            'end_date' => $actie->end_date,
            'end_time' => $actie->end_time,
            'created_at' => $actie->created_at,
            'updated_at' => $actie->updated_at,
            'image_url' => $actie->image_url,
            'organizers' => $actie->organizers->map(fn ($o) => ['name' => $o->name, 'link' => $o->link])->values(),
            'themes' => $actie->themes->map(fn ($t) => ['id' => $t->id, 'name' => $t->name, 'color' => $t->color])->values(),
        ]]);
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
