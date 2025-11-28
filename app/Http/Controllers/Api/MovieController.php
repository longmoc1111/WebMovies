<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest\StoreMovieRequest;
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
    public function index()
    {
        return MovieResource::collection(Movie::orderBy("created_at", "ASC")->with(["Genres", "Countries"])->paginate(20));
    }
    public function createData()
    {
        return [
            "genres" => Genre::all(),
            "countries" => Country::all(),
            "directors" => Director::all(),
            "actors" => Actor::all(),
            "types" => Type::all(),
        ];
    }
    public function store(StoreMovieRequest $request)
    {
        $data = $request->validated();
        if ($data["MovieImage"]) {
            $file = $data["MovieImage"];
            $fileNameWithowEtx = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithowEtx . "_" . time() . "." . $fileNameExt;
            $file->move(storage_path("app/public/upload/image"),$newFileName);
            $data["MovieImage"] = $newFileName;
        }
        $movie = Movie::create([
            'MovieName' => $data['MovieName'],
            'MovieYear' => $data['MovieYear'],
            'MovieDescription' => $data['MovieDescription'],
            'MovieEvaluate' => $data['MovieEvaluate'],
            'MovieStatus' => $data['MovieStatus'],
            'MovieLink' => $data['MovieLink'],
            'MovieImage' => $data['MovieImage'],
            'GenreID' => $data['GenreID'],
        ]);
        if($data["DirectorID"]){
            $movie->Directors()->attach($data["DirectorID"]);
        }
        if($data["ActorID"]){
            $movie->Actors()->attach($data["ActorID"]);
        }
        if($data["TypeID"]){
            $movie->Types()->attach($data["TypeID"]);
        }
        if($data["CountryID"]){
            $movie->Countries()->attach($data["CountryID"]);
        }

        return response($data);
    }
}
