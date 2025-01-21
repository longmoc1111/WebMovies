<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\GenreMovie;
class GenreMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        for($i = 0; $i < 10; $i++){
            GenreMovie::create([
                'MovieID'=>$faker->numberBetween(1,9),
                'GenreID'=>$faker->numberBetween(1,9),
         ]);        
    }       
    }
}
