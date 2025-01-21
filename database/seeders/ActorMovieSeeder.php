<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ActorMovie;
class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        for($i = 0; $i < 10; $i++){
            ActorMovie::create([
                'ActorID'=>$faker->numberBetween(1,9),
                'MovieID'=>$faker->numberBetween(1,9),
         ]);        
    }       
    }
}
