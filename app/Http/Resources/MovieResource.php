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
            "MovieYear" =>$this->MovieYear ,
            "MovieDescription"=>$this->MovieDescription,
            "MovieEvaluate"=>$this->MovieEvaluate,
            "MovieStatus"=>$this->MovieStatus,
            "MovieImage"=> $this->MovieImage,
            "MovieLink"=>$this->MovieLink,
            "Genres" => $this->Genres ? $this->Genres->GenreName : null,
            "Countries" => $this->Countries ? $this->Countries->map(function($country){
               return [
                    "CountryName" => $country->CountryName
               ];
            }) : [],

        ];
    }
}
