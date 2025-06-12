<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ram;

class RamSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            Ram::create([
                'dung_luong' => fake()->regexify('RAM [A-Z]{2}[0-9]{4}'),
                'mo_ta' => fake()->sentence(),
            ]);
        }
    }
}
