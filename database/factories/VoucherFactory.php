<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_voucher' => $this->faker->unique()->word,
            'description' => $this->faker->sentence(),
            'diskon' => $this->faker->numberBetween(1000, 10000),
            'minimal_pembayaran' => $this->faker->numberBetween(50000, 100000),
            'tanggal_mulai_berlaku' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'tanggal_berakhir_berlaku' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'id_user' => null, // Jika Anda ingin menambahkan ID pengguna (foreign key)
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
