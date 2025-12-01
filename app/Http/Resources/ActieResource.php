<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
