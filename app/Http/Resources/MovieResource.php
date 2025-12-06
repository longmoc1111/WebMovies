<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            "CountryID" => $this->Countries ? $this->Countries->pluck("CountryID") : [],
            "ActorID" => $this->Actors ? $this->Actors->pluck("ActorID"): [],
            "DirectorID" => $this->Directors ? $this->Directors->pluck("DirectorID") : [],
            "TypeID" => $this->Types ? $this->Types->pluck("TypeID") : [],
            "Episodes" =>$this->Episodes ? $this->Episodes->map(function($ep){
              return   [
                    "EpisodeName" => $ep->EpisodeName,
                    "EpisodeID" =>$ep->EpisodeID,
                ];
            }) : [],
            "Servers" => $this->Episodes ? $this->Episodes->flatmap(function($ep) {
                    return  $ep->Servers->map(function($sv){
                       return [
                            "ServerID" => $sv->ServerID,
                            "ServerName" => $sv->ServerName,
                            "Link_embed" => $sv->Link_embed,
                            "Link_m3u8" => $sv->Link_m3u8,
                        ];
                    });
            }) : [], 
        ];
    }
}
