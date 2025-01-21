<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\models\Movie;
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $Name = ['deadpood', 'Iron man', 'x-men'];
        $Year = ['2002','2010','2015','2018'];
        $Evaluate = ['4.6','5.7','8,2'];
        for($i = 0; $i < 10; $i++){
            Movie::create([
                'MovieName'=>$faker->randomElement($Name),
                'MovieYear'=>$faker->randomElement($Year),
                'MovieDescription'=>'là một bộ phim hay',
                'MovieEvaluate'=>$faker->randomElement( $Evaluate),
                'MovieStatus'=>'hoạt động',
                'MovieImage'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCDFsfYY7IFU2BLuKXMwenHFIEtL1bFH1hhQ&s',
                'MovieLink'=>'#',
                'GenreID'=>$faker->numberBetween(1,3),
         ]);         
    }
    }
}
