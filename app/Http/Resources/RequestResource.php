<?php

namespace App\Http\Resources;

use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'duration' =>$this->mode?->duration ?? $this->delivrable->duration  ,
            'status' => $this->status,
            'number' => $this->number,
            'user'=>UserResource::make($this->user),
            'delivrable' => DelivrableResource::make($this->delivrable),
            'mode'=>ModeResource::make($this->mode),
            'user_data' => json_decode($this->user_data),
            'date' => $this->created_at->format('l d, M Y'),
            'time' => $this->date->format('h:i'),
        ];
    }
}
