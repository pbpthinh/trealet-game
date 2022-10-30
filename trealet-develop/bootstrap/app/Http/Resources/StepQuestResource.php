<?php

namespace Vanguard\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepQuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_str' => $this->id_str,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'published' => $this->published,
            'json' => json_decode($this->json, false, 512, JSON_UNESCAPED_UNICODE),
            'state' => $this->state,
            'open_at' => $this->open_at,
            'close_at' => $this->close_at,
        ];
    }
}
