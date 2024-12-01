<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'max_participants' => $this->max_participants,
            'current_participants' => $this->current_participants,
            'open_until' => $this->open_until,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'venue' => $this->venue,
            'online_platform' => $this->online_platform,
            'online_link' => $this->online_link,
            'ticket_price' => $this->ticket_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category_id' => $this->category_id,
        ];
    }
}
