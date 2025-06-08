<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Chip;

class ChipSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số chip giả
        foreach (range(1, 5) as $index) {
            Chip::create([
                'ten' => $faker->word,
                'mo_ta' => $faker->sentence,
            ]);
        }
    }
}
