<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\DanhMuc;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $tenDanhMuc = ['Laptop', 'PC Gaming', 'Linh kiện', 'Màn hình', 'Phụ kiện'];

        foreach ($tenDanhMuc as $ten) {
            DanhMuc::create([
                'ten' => $ten,
            ]);
        }
    }
}
