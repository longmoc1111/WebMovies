<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\LoginController;


Route::controller(LoginController::Class)->prefix('Login')->name('Login')->group(function(){
    route::get('/','index')->name('.index');
    route::post('/login','login')->name('.login');
});

// Route::get('/',[DashboardController::class,'index']);

Route::controller(DashboardController::class)->prefix('Dashboard')->name('Dashboard')->group(function(){
    route::get('/','index')->name('.index');
}); 

Route::controller(MoviesController::class)->prefix('Movies')->name('Movies')->group(function(){
    // route::get('/','index')->name('.index');
    route::get('/','index')->name('.index');
    route::get('/create','create')->name('.create');
    route::post('/store','store')->name('.store');
    route::get('/show/{MovieID}','show')->name('.show');
    route::delete('/{MovieID}','destroy')->name('.destroy');
    route::get('/edit/{MovieID}','edit')->name('.edit');
    route::put('/update/{MovieID}','update')->name('.update');
});