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
<<<<<<< HEAD
        // Tạo theo migration 0001_01_01_000000_create_users_table
        User::factory(2)->create();
        
       
=======
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
>>>>>>> origin
    }
}
