<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\TypeMovie;
class TypeMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        for($i = 0; $i < 10; $i++){
            TypeMovie::create([
                'MovieID'=>$faker->numberBetween(0,9),
                'typeID'=>$faker->numberBetween(1,3),
         ]);     
    }
    }
}
