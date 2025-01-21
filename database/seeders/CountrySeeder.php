<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Country;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $contries = ['Mĩ', 'Nhật', 'Pháp', 'Thái lan'];
        for($i = 0; $i < 10; $i++){
            Country::create([
                'CountryName'=>$faker->randomElement($contries),
            ]);
            
        }
    }
}
