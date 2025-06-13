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
        foreach (range(1, 10) as $i) {
            Chip::create([
                'ten' => $faker->regexify('Intel Core i[3579]-[0-9]{4}'),
                'mo_ta' => $faker->sentence(),
            ]);
        }
    }
}
