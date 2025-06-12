<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mainboard;

class MainboardSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            Mainboard::create([
                'ten' => fake()->regexify('Mainboard [A-Z]{2}-[0-9]{3}'),
                'mo_ta' => fake()->sentence(8),
            ]);
        }
    }
}
