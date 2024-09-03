<?php

namespace App\Http\Resources;

use App\Models\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DelivrableResource extends JsonResource
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
            'price' => $this->price,
            'duration' => $this->duration,
            'modes' => ModeResource::collection($this->modes),
            'scan_copy' => Constant::find(4)->value,
        ];
    }
}
