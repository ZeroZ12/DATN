<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PhuongThucThanhToan;

class PhuongThucThanhToanSeeder extends Seeder
{
    public function run()
    {
        $methods = ['Thanh toán khi nhận hàng', 'Chuyển khoản ngân hàng', 'Ví điện tử Momo', 'Thẻ tín dụng'];

        foreach ($methods as $method) {
            PhuongThucThanhToan::create([
                'ten' => $method,
                'mo_ta' => 'Phương thức: ' . $method,
            ]);
        }
    }
}


