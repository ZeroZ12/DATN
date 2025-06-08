<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ThuongHieu;

class ThuongHieuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số thương hiệu giả
        foreach (range(1, 5) as $index) {
            ThuongHieu::create([
                'ten' => $faker->company,
            ]);
        }
    }
}

