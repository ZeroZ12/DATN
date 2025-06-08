<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PhuongThucThanhToan;

class PhuongThucThanhToanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số phương thức thanh toán giả
        foreach (range(1, 3) as $index) {
            PhuongThucThanhToan::create([
                'ten' => $faker->word,
                'mo_ta' => $faker->sentence,
                'hoat_dong' => true,
            ]);
        }
    }
}

