<?php

namespace App\Http\Resources;

use App\Models\Request as ModelsRequest;
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
            'paid' => $this->paid,
            'scan_copy' => $this->scan_copy,
            'user'=>UserResource::make($this->user),
            'delivrable' => DelivrableResource::make($this->delivrable),
            'mode'=>ModeResource::make($this->mode),
            'payment_method'=>$this->payment->payment_method,
            'user_data' => json_decode($this->user_data),
            'date' => $this->created_at,
            'available_status'=>['pending', 'assigned', 'processing', 'received', 'delivered', 'completed'],
            'time' => $this->date,
        ];
    }
}
