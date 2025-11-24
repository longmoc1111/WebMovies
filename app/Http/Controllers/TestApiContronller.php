<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use App\Models\Movie;

class TestApiContronller extends Controller
{
    public function index(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
        ])->get('https://ophim1.com/v1/api/phim/luat-su-xuat-chung');
        $data = $response->json();
        $directors = $data['data']['item']["country"][1]["name"]?? [];
        return $directors;
    }
}
