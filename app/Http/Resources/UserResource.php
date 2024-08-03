<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id' => $this->id,
            'email' => $this->email ?? "",
            'name' => $this->name??'',
            'first_name' => $this->first_name,
            'last_name' =>$this->last_name,
            'profile' => $this->profile?asset('storage/' . $this->profile):asset('be_assets/images/users/avatar-1.jpg'),
            'phone' => $this->phone,
            'role' => $this->role ?? "",
            'company' => $this->company ?? "",
            'address' => $this->address ?? "",
            'referal_code' => $this->referal_code ?? "",
            'school' => $this->school ?? "",
            'faculty' => $this->faculty ??'',
            'department' => $this->department ?? '',
            'level' => $this->level ?? '',
            'matricule' => $this->matricule?? '',
            'created_at' => $this->created_at??'',
            'email_verified_at' => $this->email_verified_at ?? ''
        ];

        return $result;
    }
}
