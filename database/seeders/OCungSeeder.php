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

        $loaiOCung = ['HDD', 'SSD', 'NVMe'];

        foreach (range(1, 10) as $i) {
            OCung::create([
                'loai' => $faker->randomElement($loaiOCung), 
                'dung_luong' => $faker->randomElement(['256GB', '512GB', '1TB', '2TB']),
                'mo_ta' => $faker->sentence(),
            ]);
        }
    }
}
