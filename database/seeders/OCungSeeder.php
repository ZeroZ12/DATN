<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\OCung;

class OCungSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số ổ cứng giả
        foreach (range(1, 5) as $index) {
            OCung::create([
                'loai' => $faker->word,
                'dung_luong' => $faker->word,
                'mo_ta' => $faker->sentence,
            ]);
        }
    }
}

