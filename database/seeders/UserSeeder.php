<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        \Faker\Factory::create('vi_VN'); // Ngôn ngữ Việt

        foreach (range(1, 10) as $i) {
            User::create([
                'ten_dang_nhap' => 'user' . $i,
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'ho_ten' => fake()->name(),
                'so_dien_thoai' => fake()->phoneNumber(),
                'vai_tro' => fake()->randomElement(['khach_hang', 'quan_tri']),
                'trang_thai' => fake()->randomElement(['hoat_dong', 'vo_hieu']),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
