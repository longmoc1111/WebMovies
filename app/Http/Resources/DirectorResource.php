<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "DirectorID" => $this->DirectorID,
            "DirectorName" => $this->DirectorName,
            "DirectorNationality"=> $this->DirectorNationality,
            "DirectorDate"=>$this->DirectorDate,
            "DirectorAvatar"=>$this->DirectorAvatar,
            


        ];
    }
}
