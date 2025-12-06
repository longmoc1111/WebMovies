<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest\StoreMovieRequest;
use App\Http\Requests\MovieRequest\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieViewResource;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Server;
use App\Models\Type;
use App\Models\User;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use File;

class MovieController extends Controller
{
    public function index()
    {
        return MovieViewResource::collection(Movie::orderBy("created_at", "ASC")->with(["Genres", "Countries"])->paginate(50));
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
        $episodes = json_decode($data["Episodes"]);
        if ($request->hasFile("MovieImage")) {
            $file = $data["MovieImage"];
            $fileNameWithowEtx = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithowEtx . "_" . time() . "." . $fileNameExt;
            $file->move(storage_path("app/public/upload/image"), $newFileName);
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
            'MovieQuality' => $data['MovieQuality'],
            'TotalEpisode' => $data['TotalEpisode'],

        ]);
        if ($data["DirectorID"]) {
            $movie->Directors()->attach($data["DirectorID"]);
        }
        if ($data["ActorID"]) {
            $movie->Actors()->attach($data["ActorID"]);
        }
        if ($data["TypeID"]) {
            $movie->Types()->attach($data["TypeID"]);
        }
        if ($data["CountryID"]) {
            $movie->Countries()->attach($data["CountryID"]);
        }
        foreach ($episodes as $ep) {
            $episode = Episode::create([
                "EpisodeName" => $ep->EpisodeName,
                "MovieID" => $movie->MovieID
            ]);
            if ($episode) {
                foreach($ep->sources as $sc)
                $server = Server::create([
                    "ServerName" => $sc->ServerName,
                    "Link_m3u8" => $sc->Link_m3u8,
                    "Link_embed" => $sc->Link_embed,
                    "EpisodeID" => $episode->EpisodeID
                ]);
            }
        }

        return response($episodes);
    }
    public function updateData() {}
    public function show(Movie $movie)
    {
        return [
            "movies" => new MovieResource($movie),
            "genres" => Genre::all(),
            "countries" => Country::all(),
            "types" => Type::all(),
            "actors" => Actor::all(),
            "directors" => Director::all()
        ];
    }
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile("MovieImage")) {
            if ($movie->MovieImage) {
                $oldFileName = storage_path("app/public/upload/image/" . $movie->MovieImage);
                if (File::exists($oldFileName)) {
                    File::delete($oldFileName);
                }
            }
            $file = $data["MovieImage"];
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $file->move(storage_path("app/public/upload/image"), $newFileName);
            $data["MovieImage"] = $newFileName;
        } else {
            $data["MovieImage"] = $movie->MovieImage;
        }
        $movie->update([
            'MovieName' => $data['MovieName'],
            'MovieYear' => $data['MovieYear'],
            'MovieDescription' => $data['MovieDescription'],
            'MovieEvaluate' => $data['MovieEvaluate'],
            'MovieStatus' => $data['MovieStatus'],
            'MovieLink' => $data['MovieLink'],
            'MovieImage' => $data['MovieImage'],
            'GenreID' => $data['GenreID'],
        ]);
        if ($data["DirectorID"]) {
            $movie->Directors()->sync($data["DirectorID"]);
        }
        if ($data["ActorID"]) {
            $movie->Actors()->sync($data["ActorID"]);
        }
        if ($data["CountryID"]) {
            $movie->Countries()->sync($data["CountryID"]);
        }
        if ($data["TypeID"]) {
            $movie->Types()->sync($data["TypeID"]);
        }
        return response()->json([
            "message" => "Cập nhật thành công!",
        ]);
    }
    public function destroy(Movie $movie)
    {
        if (!$movie) {
            return;
        }
        $movie->Actors()->detach();
        $movie->Directors()->detach();
        $movie->Countries()->detach();
        $movie->Types()->detach();
        if ($movie->MovieImage != null) {
            $fileName = storage_path("app/public/upload/image/" . $movie->MovieImage);
            if (File::exists($fileName)) {
                File::delete($fileName);
            }
        }
        $episodes = $movie->Episodes;
        foreach($episodes as $ep){
            $ep->Servers()->delete();
            $ep->delete();
        }
        
        $movie->delete();
        return response()->json([
            "message" => "Xóa thành công!",
        ]);
    }
}
