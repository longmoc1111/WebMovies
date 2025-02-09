<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
class Actor extends Model
{
    use HasFactory;
    protected $primaryKey = "ActorID";
    public $fillable = ['ActorID','ActorName','ActorNationality','ActorDate','ActorAvatar'];

    public function ActorMovie(){
        return $this->belongsToMany(Movie::class,'genre_movies','ActorID','MovieID');
    }
    
}
