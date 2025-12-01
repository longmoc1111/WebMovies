<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $primaryKey = 'ServerID';
    public $fillable = ["ServerID", "ServerName", "Link_embed","Link_m3U8", "EpisodeID"];

    public function ServerEpisode(){
        return $this->belongsTo(Episode::class, "EpisodeID", "EpisodeID");
    }
}
