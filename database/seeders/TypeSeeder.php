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
        $Type = ['khoa học viễn tưởng', 'kinh dị', 'phim hài','phim hoạt hình'];
        for($i = 0; $i < 10; $i++){
            Type::create([
                'TypeName'=>$faker->randomElement($Type),
            ]);          
    }
}
}
