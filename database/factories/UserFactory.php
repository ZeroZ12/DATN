<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'ten_dang_nhap' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'ho_ten' => fake()->name(),
            'so_dien_thoai' => fake()->phoneNumber(),
            'vai_tro' => '1',
            'trang_thai' => 'hoat_dong',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
=======
            'ten_dang_nhap'     => $this->faker->unique()->userName(),
            'ho_ten'            => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'so_dien_thoai'     => $this->faker->phoneNumber(),
            'vai_tro'           => $this->faker->randomElement(['khach_hang', 'quan_tri']),
            'trang_thai'        => $this->faker->randomElement(['hoat_dong', 'vo_hieu', 'an']),
            'remember_token'    => Str::random(10),
>>>>>>> origin
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
