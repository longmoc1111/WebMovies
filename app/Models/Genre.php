<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
class Genre extends Model
{
    use HasFactory;
    protected $primaryKey = "GenreID";
    protected $keyType = 'int'; 
    public $fillable = ['GenreID','GenreName'];
    public function GenreMovie(){
        return $this->hasMany(Movie::class,'MovieID');
    }


}
