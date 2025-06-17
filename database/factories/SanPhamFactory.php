<?php

namespace Database\Factories;

use App\Models\Gpu;
use App\Models\Chip;
use App\Models\DanhMuc;
use App\Models\Mainboard;
use App\Models\ThuongHieu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SanPham>
 */
class SanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten' => $this->faker->word,
            'ma_san_pham' => $this->faker->unique()->word,
            'mo_ta' => $this->faker->sentence,
            'id_chip' => Chip::factory(),
            'id_gpu' => Gpu::factory(),
            'id_mainboard' => Mainboard::factory(),
            'id_category' => DanhMuc::factory(),
            'id_brand' => ThuongHieu::factory(),
            'bao_hanh_thang' => $this->faker->numberBetween(1, 24), // Warranty in months
            'hoat_dong' => $this->faker->boolean(80), // 80% chance of being active
            'anh_dai_dien' => $this->faker->imageUrl(640, 480, 'technics', true, 'Product Image'),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
