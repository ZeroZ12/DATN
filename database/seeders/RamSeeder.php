<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Ram;

class RamSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số RAM giả
        foreach (range(1, 5) as $index) {
            Ram::create([
                'dung_luong' => $faker->word,
                'mo_ta' => $faker->sentence,
            ]);
        }
    }
}

