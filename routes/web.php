<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\LoginController;
use App\http\Controllers\AuthController;
use App\http\Controllers\ActorController;
use App\http\Controllers\HomeController;


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
    Route::middleware(["auth","admin"])->prefix("Dashboard")->name('Dashboard.')->group(function(){
        route::get('/',[DashboardController::class, 'index'])->name('index');
    }); 
    
Route::middleware(["auth", "admin"])->prefix("Movies")->name("Movies.")->group(function(){
    route::get('/',[MoviesController::class,'index'])->name('index');
    route::get('/create',[MoviesController::class,'create'])->name('create');
    route::post('/store',[MoviesController::class,'store'])->name('store');
    route::get('/show/{MovieID}',[MoviesController::class,'show'])->name('show');
    route::delete('/{MovieID}',[MoviesController::class,'destroy'])->name('destroy');
    route::get('/edit/{MovieID}',[MoviesController::class,'edit'])->name('edit');
    route::put('/update/{MovieID}',[MoviesController::class,'update'])->name('update');
});
  
Route::middleware(["auth","admin"])->prefix("Actor")->name("Actor.")->group(function(){
    route::get("/",[ActorController::class,"index"])->name("index");
});

Route::prefix("Home")->name("Home.")->group(function(){
    Route::get("/",[HomeController::class,"index"])->name("index");
    Route::get("/detail/{MovieID}",[HomeController::class,"detailMovie"])->name("detail");
    Route::get("/viewAll",[HomeController::class,"viewAll"])->name("viewAll");
});

// Route::controller(MoviesController::class)->prefix('Movies')->name('Movies')->group(function(){

// });