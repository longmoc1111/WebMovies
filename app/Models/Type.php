<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
class Type extends Model
{
    use HasFactory;
    protected $primaryKey = "TypeID";
    public $fillable = ['TypeID','TypeName'];
    public function TypeMovie(){
        return  $this->belongsToMany(Movie::class,'type_movies','TypeID','MovieID');
    }

}
