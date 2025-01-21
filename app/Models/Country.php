<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
class Country extends Model
{
    use HasFactory;
    protected $primaryKey = "CountryID";
    protected $keyType = 'int'; 
    public $fillable = ['CountryID','CountryName'];
    public function CountryMovie(){
        return $this->belongsToMany(Movie::class,'country_movies','CountryID','MovieID');
    }
}
