<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    use HasFactory;
    protected $primaryKey = "GenreMovieID";
    public $fillable = ['GenreMovieID','MovieID','GenreID'];


}
