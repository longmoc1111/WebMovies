<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\CountryMovie;
class CountryMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        for($i = 0; $i < 10; $i++){
            CountryMovie::create([
                'MovieID'=>$faker->numberBetween(1,9),
                'CountryID'=>$faker->numberBetween(1,3),
         ]);        
    }       
    }
}
