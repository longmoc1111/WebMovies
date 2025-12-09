<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $Type =["Phim bộ", "Phim lẻ"];
        for($i = 0; $i < 2; $i++){
            Type::create([
                'TypeName'=>$faker->randomElement($Type),
            ]);          
    }
}
}
