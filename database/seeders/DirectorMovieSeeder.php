<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\DirectorMovie;
class DirectorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $faker  = Faker::create();
        for($i = 0; $i < 10; $i++){
            DirectorMovie::create([
                'DirectorID'=>$faker->numberBetween(1,9),
                'MovieID'=>$faker->numberBetween(1,9),
         ]);        
    }       
    }
}
