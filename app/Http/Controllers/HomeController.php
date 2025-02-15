<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Director;
use App\Models\Type;
use App\Models\Genre;
use App\Models\Country;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::OrderBy("created_at", "DESC")->get();
        return view("home.index", compact("movies"));
    }
    public function detailMovie(string $id)
    {
        $movies = Movie::OrderBy("created_at", "DESC")->get();
        $movieID = Movie::find($id);
        return view("home.detailMovie", compact("movieID", "movies"));
    }
    public function viewAll()
    {
        $Types = Type::all();
        $Genres = Genre::all();
        $Countries = Country::all();
        $title = "Danh mục";
        $Movies = Movie::orderby("created_at", "DESC")->paginate(18);
        return view("home.viewAllMovie", compact("Movies", "Types", "Genres", "Countries", "title"));

    }
    public function theaterMovie()
    {
        $Types = Type::all();
        $Genres = Genre::all();
        $Countries = Country::all();
        $title = "phim chiếu rạp";
        $Movies = Movie::whereHas("Genres", function ($query) {
            $query->where("GenreName", "phim chiếu rạp");
        })->paginate(18);
        return view("home.viewAllMovie", compact("Movies", "Types", "Genres", "Countries", "title"));


    }
    public function singleMovie()
    {
        $Types = Type::all();
        $Genres = Genre::all();
        $Countries = Country::all();
        $title = "phim lẻ";
        $Movies = Movie::whereHas("Genres", function ($query) {
            $query->where("GenreName", "phim lẻ");
        })->paginate(18);
        return view("home.viewAllMovie", compact("Movies", "Types", "Genres", "Countries", "title"));
    }
    public function search()
    {
        $search = request("search");
        $Types = Type::all();
        $Genres = Genre::all();
        $Countries = Country::all();
        $title = "Tìm kiếm";
        $Movies = Movie::where("MovieName", "like", "%" . $search . "%")->paginate(18)->appends(request()->query());
        return view("home.viewAllMovie", compact("Movies", "Types", "Genres", "Countries", "title"));
    }

    public function filter()
    {
        $Types = Type::all();
        $Genres = Genre::all();
        $Countries = Country::all();
        $title = "Lọc";
        $Catalog = request("Danhmuc");
        $Country = request("Quocgia");
        $Type = request("Theloai");

        $Movies = Movie::query();

        if(!empty($catalog)){
            $Movies->whereHas("Genres", function ($query) use ($Catalog) {
                $query->where("GenreName", $Catalog);
        });
    }
        if(!empty($Country)){
            $Movies->whereHas("Countries", function ($query) use ($Country){
                $query->where("CountryName", $Country);
        });
    }
        if(!empty($Type)){
            $Movies->whereHas("Types", function ($query) use ($Type) {
                $query->where("TypeName", $Type);
        });
    }
        $Movies =  $Movies->paginate(18)->appends(request()->query());
        return view("home.viewAllMovie", compact("Movies", "Types", "Genres", "Countries", "title"));
    }

}
