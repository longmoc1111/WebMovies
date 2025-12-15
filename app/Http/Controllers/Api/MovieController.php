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
        return MovieViewResource::collection(Movie::orderBy("created_at", "ASC")->paginate(10));
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
            $file = $request->file("MovieImage");
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
            'TypeID' => $data['TypeID'],
            "MovieType" => $data["MovieType"],
            'MovieQuality' => $data['MovieQuality'],
            'TotalEpisode' => $data['TotalEpisode'],

        ]);
        if ($data["DirectorID"]) {
            $movie->Directors()->attach($data["DirectorID"]);
        }
        if ($data["ActorID"]) {
            $movie->Actors()->attach($data["ActorID"]);
        }
        if ($data["GenreID"]) {
            $movie->Genres()->attach($data["GenreID"]);
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
                foreach ($ep->sources as $sc) {
                    $server = Server::create([
                        "ServerName" => $sc->ServerName,
                        "Link_m3u8" => $sc->Link_m3u8,
                        "Link_embed" => $sc->Link_embed,
                        "EpisodeID" => $episode->EpisodeID
                    ]);
                }
            }
        }

        return response($episodes);
    }
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
        $episodes = json_decode($data["Episodes"]);
        if ($request->hasFile("MovieImage")) {
            if ($movie->MovieImage) {
                $oldFileName = storage_path("app/public/upload/image/" . $movie->MovieImage);
                if (File::exists($oldFileName)) {
                    File::delete($oldFileName);
                }
            }
            $file = $request->file("MovieImage");
            $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNameExt = $file->getClientOriginalExtension();
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileNameExt;
            $file->move(storage_path("app/public/upload/image"), $newFileName);
            $data["MovieImage"] = $newFileName;
        } else {
            $data["MovieImage"] = $movie->MovieImage;
        }
        $movie->fill([
            'MovieName' => $data['MovieName'],
            'MovieYear' => $data['MovieYear'],
            'MovieDescription' => $data['MovieDescription'],
            'MovieEvaluate' => $data['MovieEvaluate'],
            'MovieStatus' => $data['MovieStatus'],
            'MovieLink' => $data['MovieLink'],
            'MovieImage' => $data['MovieImage'],
            'TypeID' => $data['TypeID'],
            "TotalEpisode" => $data["TotalEpisode"],
            "MovieType" => $data["MovieType"],
        ]);
        if ($movie->isDirty()) {
            $movie->save();
        }
        if ($data["DirectorID"]) {
            $movie->Directors()->sync($data["DirectorID"]);
        }
        if ($data["ActorID"]) {
            $movie->Actors()->sync($data["ActorID"]);
        }
        if ($data["CountryID"]) {
            $movie->Countries()->sync($data["CountryID"]);
        }
        if ($data["GenreID"]) {
            $movie->Genres()->sync($data["GenreID"]);
        }
        if ($episodes) {
            foreach ($episodes as $ep) {
                //cập nhật đối với tập cũ
                if (!empty($ep->EpisodeID)) {
                    $episode = Episode::find($ep->EpisodeID);
                    if (!$episode) continue;
                    $episode->fill([
                        "EpisodeName" => $ep->EpisodeName,
                    ]);
                    if ($episode->isDirty()) {
                        $episode->save();
                    }
                    if (!empty($ep->sources)) {
                        foreach ($ep->sources as $sv) {
                            if (!empty($sv->ServerID)) {
                                $serve = Server::find($sv->ServerID);
                                if (!$serve) continue;
                                $serve->fill([
                                    "ServerName" => $sv->ServerName,
                                    "Link_embed" => $sv->Link_embed,
                                    "Link_m3u8" => $sv->Link_m3u8
                                ]);
                                if ($serve->isDirty()) {
                                    $serve->save();
                                }
                            } else if(empty($sv->ServerID)) {
                                Server::create([
                                    "ServerName" => $sv->ServerName,
                                    "Link_embed" => $sv->Link_embed,
                                    "Link_m3u8" => $sv->Link_m3u8,
                                    "EpisodeID" => $episode->EpisodeID
                                ]);
                            }
                        }
                    }
                //doi voi tap them moi
                } else {
                    $newEp =  Episode::create([
                        "EpisodeName" => $ep->EpisodeName,
                        "MovieID" => $movie->MovieID
                    ]);
                    foreach ($ep->sources as $sv) {
                        Server::create([
                            "ServerName" => $sv->ServerName,
                            "Link_embed" => $sv->Link_embed,
                            "Link_m3u8" => $sv->Link_m3u8,
                            "EpisodeID" => $newEp->EpisodeID
                        ]);
                    }
                }
            }
        }
        return response()->json([
            "message" => "Cập nhật thành công!",
        ]);
        // return response($episodes);
    }
    public function destroy(Movie $movie)
    {
        if (!$movie) {
            return;
        }
        $movie->Actors()->detach();
        $movie->Directors()->detach();
        $movie->Countries()->detach();
        $movie->Genres()->detach();
        if ($movie->MovieImage != null) {
            $fileName = storage_path("app/public/upload/image/" . $movie->MovieImage);
            if (File::exists($fileName)) {
                File::delete($fileName);
            }
        }
        $episodes = $movie->Episodes;
        foreach ($episodes as $ep) {
            $ep->Servers()->delete();
            $ep->delete();
        }

        $movie->delete();
        return response()->json([
            "message" => "Xóa thành công!",
        ]);
    }
    
    public function deleteEpisodes(Request $request){
      $data = $request->episodes;
    if($data){
        foreach($data as $dt){
            $episode = Episode::find($dt["EpisodeID"]);
            if(!$episode) continue;
            $episode->Servers()->delete();
            $episode->delete();
        }
    }
      return response()->json([
        "message" => "dữ liệu các tập phim đã được xóa!",
      ]);
    }

    
    public function deleteSingleEpisode($id){
        $data = Episode::find($id);
        if($data){
            $data->Servers()->delete();
            $data->delete();    
        }
        return response()->json("xóa thành công tập phim!");
    }
    public function deleteServer($id){
        $server = Server::find($id);
        if($server){
            $server->delete();
        }
        return response()->json( "xóa thành công nguồn phim!");
    }
}
