<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Type;
 
class Movie extends Model
{
    use HasFactory;
    protected $primaryKey = "MovieID";
    public $fillable = ['MovieID','MovieName','MovieYear','MovieDescription','MovieEvaluate','MovieStatus','MovieQuality','TotalEpisode','MovieImage','MovieLink','GenreID'];

    public function Countries(){
        return $this->belongsTomany(Country::class,'country_movies','MovieID','CountryID');  
    }
    public function Directors(){
        return $this->belongstomany(Director::class,'director_movies','MovieID','DirectorID');  
    }
    public function Actors(){
        return $this->belongstomany(Actor::class,'actor_movies','MovieID','ActorID');  
    }

    public function Types(){
        return $this->belongsToMany( Type::class,'type_movies','MovieID','TypeID');;
    }

    public function Genres(){
        return $this->Belongsto(Genre::class,'GenreID',"GenreID");  
    }
    public function Episodes(){
        return $this->hasMany(Episode::class, "MovieID", "MovieID");
    }

}