<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $primaryKey = 'EpisodeID';

    public $fillable = ["EpisodeID","EpisodeName","MovieID"];

    public function EpisodeMovie(){
        return $this->belongsTo(Movie::class, "MovieID","MovieID");
    }

    public function Servers(){
        return $this->hasMany(Server::class, "EpisodeID", "EpisodeID");
    }
}
