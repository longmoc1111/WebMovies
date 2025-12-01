<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "MovieID" => $this->MovieID,
            "MovieName" => $this->MovieName,
            "MovieYear" => $this->MovieYear,
            "MovieDescription" => $this->MovieDescription,
            "MovieEvaluate" => $this->MovieEvaluate,
            "MovieStatus" => $this->MovieStatus,
            "MovieImage" => $this->MovieImage,
            "MovieLink" => $this->MovieLink,
            "GenreID" => $this->Genres ? $this->Genres->GenreID : null,
            "Countries" => $this->Countries ? $this->Countries->pluck("CountryName") : [],
            "Actors" => $this->Actors ? $this->Actors->pluck("ActorName") : [],
            "Directors" => $this->Directors ? $this->Directors->pluck("DirectorName") : [],
            "Types" => $this->Types ? $this->Types->pluck("TypeName") : [],
        ];
    }
}
