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
            "TypeID" => $this->TypeID,
            "MovieQuality" => $this->MovieQuality,
            "TotalEpisode" => $this->TotalEpisode,
            "CountryID" => $this->Countries ? $this->Countries->pluck("CountryID") : [],
            "MovieType" => $this->MovieType,
            "ActorID" => $this->Actors ? $this->Actors->pluck("ActorID"): [],
            "DirectorID" => $this->Directors ? $this->Directors->pluck("DirectorID") : [],
            "GenreID" => $this->Genres ? $this->Genres->pluck("GenreID") : [],
            // "TypeID" => $this->Types ? $this->Types->pluck("TypeID") : [],
            "Episodes" => $this->Episodes ? $this->Episodes->map(function($ep){
                return [
                    "EpisodeID" =>$ep->EpisodeID,
                    "EpisodeName" => $ep->EpisodeName,
                    "sources" => $ep->Servers->map(function($sv){
                        return [
                            "ServerID" => $sv->ServerID,
                            "ServerName" => $sv->ServerName,
                            "Link_embed" => $sv->Link_embed,
                            "Link_m3u8" =>$sv->Link_m3u8
                        ];
                    })
                ];  
            }) : [],
           
        ];
    }
}
