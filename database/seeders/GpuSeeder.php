<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Gpu;

class GpuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số GPU giả
        foreach (range(1, 5) as $index) {
            Gpu::create([
                'ten' => $faker->word,
                'mo_ta' => $faker->sentence,
            ]);
        }
    }
}

