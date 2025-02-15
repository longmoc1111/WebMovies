<?php
namespace App\Http\Controllers;
use Illuminate\support\str;
use Illuminate\Http\Request;
use Illuminate\support\facades\File;
use App\Models\Movie;
use App\Models\Type;
use App\Models\Genre;
use App\Models\Director;
use App\Models\Country;
use App\Models\Actor;



class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::OrderBy("created_at","DESC")->paginate(10);     
        return view('admin.movies.index',compact('movies'));
    }

    public function create()
    {
        $Types = Type::all();
        $Genres = Genre::all();
        $Directors = Director::all();
        $Countries = Country::all();
        $Actors = Actor::all();
        return view('admin.movies.CreateMovie',compact('Types','Genres', 'Directors','Countries','Actors'));
    }

    public function store(Request $request)
    {
        $validateDataMovies = $request->validate([
            'MovieName'=>'required',
            'MovieYear'=>'required',
            'MovieDescription'=>'required',
            'MovieEvaluate'=>'required',
             'MovieImage'=>'required',
            'MovieStatus'=>'required|min:0|max:10',
            'MovieLink'=>'required|url',
            'GenreID'=>'required',            
       ]);
        // if($request->hasfile('MovieImage')){
        //     $file = $request->file('MovieImage');
        //     $fileNameWithoutExt = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        //     $fileExtension = $file->getClientOriginalExtension();
        //     $newFileName = str::slug($fileNameWithoutExt,'-'). '-' . time() . '.' . $fileExtension;
        //     $file->move(public_path('images'), $newFileName);
        //     $validateDataMovies['MovieImage'] = $newFileName;
        // }
        $movie = Movie::create($validateDataMovies);

       $validateDataDirector = $request->get('DirectorID');
        if(isset($validateDataDirector)){
            $movie->Directors()->attach($validateDataDirector);
        }   
        
        $validateDataActor = $request->get('ActorID');
        if(isset($validateDataActor)){
            $movie->Actors()->attach($validateDataActor);
        }

        $validateDataCountry = $request->get('CountryID');
        if(isset($validateDataCountry)){
            $movie->Countries()->attach($validateDataCountry);
        }

        $validateDataType = $request->get('TypeID');
        if(isset($validateDataType)){
            $movie->Types()->attach($validateDataType);
    }

    return redirect()->route('Movies.index')->with('addMovie','thêm mới thành công');
}

    public function show(string $id)
    { 
     
        $movie = Movie::find($id);
        return view('admin.movies.showMovie',compact('movie'));
    }

    public function edit(string $id)
    {
        $Movie = Movie::find($id);
        $Genres = Genre::all();
        $Types = Type::all();
        $Directors = Director::all();
        $Countries = Country::all();
        $Actors = Actor::all();
        return view('admin.movies.editMovie',compact('Movie','Types','Genres', 'Directors','Countries','Actors'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
                'MovieName'=>'required',
                'MovieYear'=>'required',
                'MovieDescription'=>'required',
                'MovieImage'=>'required',
                'MovieEvaluate'=>'required',
                'MovieStatus'=>'required|min:0|max:10',
                'MovieLink'=>'required|url',
                'GenreID'=>'required',
        ]);

        // if($request->hasfile('currentMovieImage')){
        //     $oldfileImage = public_path('images/'. $request->get('MovieImage'));
        //     if(File::exists($oldfileImage)){
        //         File::delete($oldfileImage);
        //     }
        //     else{              
        //     }
        //     $file = $request->file('currentMovieImage');
        //     $fileNameWithoutExt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //     $fileNameExtension = $file->getClientOriginalExtension();
        //     $shortFileName = str::slug($fileNameWithoutExt, '-') . '-' .  time() . '.' . $fileNameExtension;
        //     $file->move(public_path('images'), $shortFileName);
        //     $validate['MovieImage'] = $shortFileName;    
        // }

        
    
      
        $movies = Movie::find($id);
        $movies->update($validate);

        $validateDataTypes = $request->get('TypeID');
        if(isset($validateDataTypes)){
            $movies->Types()->sync($validateDataTypes);
        }

        $validateDataDirectors = $request->get('DirectorID');
        if(isset($validateDataDirectors)){
            $movies->Directors()->sync($validateDataDirectors);
        }

        $vailidateDataActors = $request->get('ActorID');
        if(isset($vailidateDataActors)){
            $movies->Actors()->sync($vailidateDataActors);
        }
        
        $validatedataCountries = $request->get('CountryID');
        if(isset($validatedataCountries)){
            $movies->Countries()->sync($validatedataCountries);
        }
        return redirect()->route('Movies.index')->with('editMovie','cập nhật thành công');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if($movie){
            $movie->Directors()->detach();
            $movie->Actors()->detach();
            $movie->Countries()->detach();
            $movie->Types()->detach();
        }
        $movie->delete();
        return redirect()->route('Movies.index')->with('deleteMovie','xóa thành công');
    }

    public function sort(){
        request("option");
        if(request("option") == "Tên phim"){
            $movies = Movie::OrderBy("MovieName","ASC")->paginate(10)->appends(request()->query());  
        return view('admin.movies.index',compact('movies'));
        }if(request("option") == "Năm ra mắt"){
            $movies = Movie::OrderBy("MovieYear","DESC")->paginate(10)->appends(request()->query());  
        return view('admin.movies.index',compact('movies'));
        }if(request("option") == "Đánh giá"){
            $movies = Movie::OrderBy("MovieEvaluate","ASC")->paginate(10)->appends(request()->query());  
        return view('admin.movies.index',compact('movies'));
        }     
    }
    public function search(){
        $key = request("search");
        $movies = Movie::where("MovieName","like","%".$key."%")
        ->orWhere("MovieEvaluate","like","%".$key."%")
        ->orWhere("MovieYear","like","%".$key."%")
        ->orWhere("MovieStatus","like","%".$key."%")
        ->paginate(10)->appends(request()->query());
        return view("admin.movies.index",compact("movies"));
    }
}
