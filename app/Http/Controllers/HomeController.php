<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Director;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
         $movies = Movie::OrderBy("created_at", "DESC")->get();
        return view("home.index",compact("movies"));
    }
    public function detailMovie(string $id){
        $movies = Movie::OrderBy("created_at", "DESC")->get();
        $movieID = Movie::find($id);
        return view("home.detailMovie",compact("movieID","movies"));
    }
    public function viewAll(){
        $viewAllMovies = Movie::orderby("created_at","DESC")->get();
        return view("home.viewAllMovie",compact("viewAllMovies"));
    }

}
