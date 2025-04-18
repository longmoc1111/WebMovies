<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorMovie extends Model
{
    use HasFactory;
    protected $primaryKey = "DirectorMovieID";
    public $fillable = ['DirectorMovieID','DirectorID','MovieID'];

}
