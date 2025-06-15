<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ThuongHieu;

class ThuongHieuSeeder extends Seeder
{
    public function run()
    {
        $brands = ['ASUS', 'MSI', 'GIGABYTE', 'Intel', 'AMD', 'Samsung', 'Kingston'];

        foreach ($brands as $brand) {
            ThuongHieu::create([
                'ten' => $brand,
            ]);
        }
    }
}
