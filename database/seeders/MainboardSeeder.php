<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Mainboard;

class MainboardSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số mainboard giả
        foreach (range(1, 5) as $index) {
            Mainboard::create([
                'ten' => $faker->word,
                'mo_ta' => $faker->sentence,
            ]);
        }
    }
}
