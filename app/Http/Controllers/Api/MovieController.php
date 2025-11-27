<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Type;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        return MovieResource::collection(Movie::orderBy("created_at", "ASC")->with(["Genres", "Countries"])->paginate(20)); 
    }
    public function createData(){
        return [
            "genres" => Genre::all(),
            "countries" => Country::all(),
            "directors" => Director::all(),
            "actors" => Actor::all(),
            "types" => Type::all(),
        ];
    }
}
