<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Actor;
class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $actor = ['Ryan Reynolds', 'Lauren Shuler Donne', 'Simon Kinberg'];
        for($i = 0; $i < 10; $i++){
            Actor::create([
                'ActorName'=>$faker->randomElement($actor),
                'ActorDate'=>'1980-01-01',
                'ActorNationality'=>'Mỹ',
                'ActorAvatar'=>'https://',
            ]);
            
        }
    }
}
