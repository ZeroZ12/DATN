<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChipSeeder::class,
            GpuSeeder::class,
            RamSeeder::class,
            MainboardSeeder::class,
            OCungSeeder::class,
            MaGiamGiaSeeder::class,
            PhuongThucThanhToanSeeder::class,
            ThuongHieuSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
