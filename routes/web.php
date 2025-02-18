<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\LoginController;
use App\http\Controllers\AuthController;
use App\http\Controllers\ActorController;
use App\http\Controllers\HomeController;
use App\http\Controllers\DirectorController;




// Route::controller(LoginController::Class)->prefix('Login')->name('Login')->group(function(){
//     route::get('/','index')->name('.index');
//     route::post('/login','login')->name('.login');
// });

// Route::get('/',[DashboardController::class,'index']);
Route::get("/login",[AuthController::class, "login"])
    ->name("login");
Route::post("/login",[AuthController::class,"loginPost"])
    ->name("login.post");

Route::get("/register",[AuthController::class, "register"])
    ->name("register");
Route::post("/register",[AuthController::class,"registerPost"])
    ->name("register.post");  
Route::post("/logout",[AuthController::class,"logout"])
    ->name("logout.post");


Route::middleware(["auth","admin:admin"])->prefix("admin")->name("admin.director.")->group(function(){
    route::get("/director/index",[DirectorController::class,"index"])->name("index");
    route::get("/director/create",[DirectorController::class,"create"])->name("create");
    route::post("/director/store",[DirectorController::class,"store"])->name("store");
    route::get("/director/edit/{DirectorID}",[DirectorController::class,"edit"])->name("edit");
    route::put("/director/update/{DirectorID}",[DirectorController::class,"update"])->name("update");
    route::delete("/director/destroy/{DirectorID}",[DirectorController::class,"destroy"])->name("destroy");
    route::get("/director/sort",[DirectorController::class,"sort"])->name("sort");
    route::get("/director/search",[DirectorController::class,"search"])->name("search");


});

Route::middleware(["auth","admin:admin"])->prefix("admin")->name("admin.actor.")->group(function(){
    route::get("/actor/index",[ActorController::class,"index"])->name("index");
    route::get("/actor/create",[ActorController::class,"create"])->name("create");
    route::post("/actor/store",[ActorController::class,"store"])->name("store");
    route::get("/actor/edit/{ActorID}",[ActorController::class,"edit"])->name("edit");
    route::put("/actor/update{ActorID}",[ActorController::class,"update"])->name("update");
    route::delete("/actor/destroy/{ActorID}",[ActorController::class,"destroy"])->name("destroy");
    route::get("actor/sort",[ActorController::class,"sort"])->name("sort");
    route::get("actor/search",[ActorController::class,"search"])->name("search");

});


Route::middleware(["auth","admin:admin"])->prefix("Dashboard")->name('Dashboard.')->group(function(){
        route::get('/',[DashboardController::class, 'index'])->name('index');
}); 
    
Route::middleware(["auth", "admin:admin"])->prefix("Movies")->name("Movies.")->group(function(){
    route::get('/',[MoviesController::class,'index'])->name('index');
    route::get('/create',[MoviesController::class,'create'])->name('create');
    route::post('/store',[MoviesController::class,'store'])->name('store');
    route::get('/show/{MovieID}',[MoviesController::class,'show'])->name('show');
    route::delete('/{MovieID}',[MoviesController::class,'destroy'])->name('destroy');
    route::get('/edit/{MovieID}',[MoviesController::class,'edit'])->name('edit');
    route::put('/update/{MovieID}',[MoviesController::class,'update'])->name('update');
    route::get("/sort",[MoviesController::class,"sort"])->name("sort");
    route::get("/search",[MoviesController::class,"search"])->name("search");
});
Route::middleware(["auth","admin:admin"])->prefix("Actor")->name("Actor.")->group(function(){
    route::get("/",[ActorController::class,"index"])->name("index");
});
route::get("Unauthorized",[AuthController::class,"Unauthorized"])->name('Unauthorized');

Route::prefix("Home")->name("Home.")->group(function(){
    Route::get("/",[HomeController::class,"index"])->name("index");
    Route::get("/detail/{MovieID}",[HomeController::class,"detailMovie"])->name("detail");
    Route::get("/viewAll",[HomeController::class,"viewAll"])->name("viewAll");
    Route::get("/theaterMovie",[HomeController::class,"theaterMovie"])->name("theaterMovie");
    Route::get("/singleMovie",[HomeController::class,"singleMovie"])->name("singleMovie");
    Route::get("/search",[HomeController::class,"search"])->name("search");
    Route::get("/filter",[HomeController::class,"filter"])->name("filter"); 
});
Route::prefix("Profile")->name("Profile.")->group(function(){
    route::get("/",[ProfileController::class,"index"])->name("index");
});

// Route::controller(MoviesController::class)->prefix('Movies')->name('Movies')->group(function(){

// });