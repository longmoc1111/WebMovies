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

class DashboardController extends Controller{

    public function index(){
        echo 'q34t';
        // return view('dashboard.index');
    }
}