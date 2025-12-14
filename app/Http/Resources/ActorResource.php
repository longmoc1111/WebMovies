<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ActorID" => $this->ActorID,
            "ActorName" => $this->ActorName,
            "ActorNationality" => $this->ActorNationality,
            "ActorDate" => $this->ActorDate,
            "ActorAvatar" => $this->ActorAvatar,
        ];
    }
}
