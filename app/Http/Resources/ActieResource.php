<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ActieResource",
 *     type="object",
 *     title="Actie Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Climate March"),
 *     @OA\Property(property="body", type="string", example="<p>Join us for...</p>"),
 *     @OA\Property(property="externe_link", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="start_date", type="string", format="date", example="2025-12-15"),
 *     @OA\Property(property="start_time", type="string", format="time", example="14:00:00"),
 *     @OA\Property(property="end_date", type="string", format="date", example="2025-12-15"),
 *     @OA\Property(property="end_time", type="string", format="time", example="18:00:00"),
 *     @OA\Property(property="start_end", type="string", example="15 Dec 2025, 14:00-18:00"),
 *     @OA\Property(property="start_unix", type="integer", example=1734271200),
 *     @OA\Property(property="location_human", type="string", example="Amsterdam Central"),
 *     @OA\Property(
 *         property="geoloc",
 *         type="object",
 *         @OA\Property(property="lat", type="number", format="float", example=52.3791),
 *         @OA\Property(property="lng", type="number", format="float", example=4.9003)
 *     ),
 *     @OA\Property(property="slug", type="string", example="climate-march"),
 *     @OA\Property(property="link", type="string", example="https://example.com/actie/climate-march"),
 *     @OA\Property(property="afgelopen", type="boolean", example=false),
 *     @OA\Property(property="disobedient", type="boolean", example=false),
 *     @OA\Property(property="pageviews", type="integer", example=150),
 *     @OA\Property(property="pageviews_text", type="string", example="150"),
 *     @OA\Property(property="organizers", type="array", @OA\Items(ref="#/components/schemas/OrganizerResource")),
 *     @OA\Property(property="categories", type="array", @OA\Items(ref="#/components/schemas/CategoryResource")),
 *     @OA\Property(property="themes", type="array", @OA\Items(ref="#/components/schemas/ThemeResource")),
 *     @OA\Property(property="image", type="object"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ActieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'externe_link' => $this->externe_link,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
            'start_end' => $this->start_end,
            'start_unix' => $this->start_unix,
            'location_human' => $this->location_human,
            'geoloc' => $this->_geoloc,
            'slug' => $this->slug,
            'link' => $this->link,
            'afgelopen' => $this->afgelopen,
            'disobedient' => $this->disobedient,
            'pageviews' => $this->pageviews,
            'pageviews_text' => $this->pageviews_text,
            'organizers' => OrganizerResource::collection($this->whenLoaded('organizers')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'themes' => ThemeResource::collection($this->whenLoaded('themes')),
            'image' => $this->linked_image,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
