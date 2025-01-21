<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Genre;
class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $genre = ['phim Chiếu rạp', 'phim bộ', 'phim lẻ'];
        for($i = 0; $i < 3; $i++){
            Genre::create([
                'GenreName'=>$faker->randomElement($genre),
            ]);         
    }
    }
}
