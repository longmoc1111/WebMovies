<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\LoginController;
use App\http\Controllers\AuthController;

// Route::controller(LoginController::Class)->prefix('Login')->name('Login')->group(function(){
//     route::get('/','index')->name('.index');
//     route::post('/login','login')->name('.login');
// });

// Route::get('/',[DashboardController::class,'index']);
Route::middleware("auth")->group(function(){
    Route::view("/home","welcome")->name('home');
});
Route::get("/login",[AuthController::class, "login"])
    ->name("login");
Route::post("/login",[AuthController::class,"loginPost"])
    ->name("login.post");

Route::get("/register",[AuthController::class, "register"])
    ->name("register");
Route::post("/register",[AuthController::class,"registerPost"])
    ->name("register.post");    
// Route::controller(DashboardController::class)->prefix('Dashboard')->name('Dashboard')->group(function(){
//     route::get('/','index')->name('.index');
// }); 

// Route::controller(MoviesController::class)->prefix('Movies')->name('Movies')->group(function(){
//     // route::get('/','index')->name('.index');
//     route::get('/','index')->name('.index');
//     route::get('/create','create')->name('.create');
//     route::post('/store','store')->name('.store');
//     route::get('/show/{MovieID}','show')->name('.show');
//     route::delete('/{MovieID}','destroy')->name('.destroy');
//     route::get('/edit/{MovieID}','edit')->name('.edit');
//     route::put('/update/{MovieID}','update')->name('.update');
// });