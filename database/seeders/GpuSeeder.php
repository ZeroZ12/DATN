<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gpu;

class GpuSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            Gpu::create([
                'ten' => fake()->regexify('GPU GTX [1-9]{3,4}'),
                'mo_ta' => fake()->sentence(),
            ]);
        }
    }
}
