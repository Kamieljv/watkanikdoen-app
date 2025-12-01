<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="OrganizerResource",
 *     type="object",
 *     title="Organizer Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Climate Action"),
 *     @OA\Property(property="logo", type="string", example="/storage/logos/climate-action.png"),
 *     @OA\Property(property="slug", type="string", example="climate-action"),
 *     @OA\Property(property="description", type="string", nullable=true),
 *     @OA\Property(property="website", type="string", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class OrganizerResource extends JsonResource
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
            'name' => $this->name,
            'logo' => $this->logo,
            'slug' => $this->slug,
            'description' => $this->when($request->routeIs('api.v1.organizers.show'), $this->description),
            'website' => $this->when($request->routeIs('api.v1.organizers.show'), $this->website),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
