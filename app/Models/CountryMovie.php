<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMovie extends Model
{
    use HasFactory;
    protected $primaryKey = "CountryMovieID";
    public $fillable = ['ContryMovieID','CountryID','MovieID'];


}
