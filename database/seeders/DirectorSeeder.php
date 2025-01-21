<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\models\Director;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $directors = ['Tim Miller', 'Stan Lee','Larry Liebe'];
        for($i = 0 ; $i < 10 ;$i++){
            Director::create([
                'DirectorName'=>$faker->randomElement($directors),
                'DirectorDate'=>'1955-02-23',
            ]);
        }

    }
}
