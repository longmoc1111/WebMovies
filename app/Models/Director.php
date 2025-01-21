<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
class Director extends Model
{
    use HasFactory;
    protected $primaryKey = "DirectorID";
    protected $keyType = "int";
    public $fillable = ['DirectorID','DirectorName','DirectorDate'];
    public function DirectorMovie(){
        return $this->belongsToMany(Movie::class,'director_movies','DirectorID','MovieID');
    }
}
