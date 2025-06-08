<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\MaGiamGia;

class MaGiamGiaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo một số mã giảm giá giả
        foreach (range(1, 5) as $index) {
            MaGiamGia::create([
                'ma' => $faker->unique()->word,
                'loai' => 'phan_tram',
                'gia_tri' => $faker->randomFloat(2, 5, 50), // giảm giá từ 5% đến 50%
                'ngay_bat_dau' => now(),
                'ngay_ket_thuc' => now()->addMonths(1),
                'hoat_dong' => true,
            ]);
        }
    }
}

