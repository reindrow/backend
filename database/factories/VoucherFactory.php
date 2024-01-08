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
            'kode_voucher' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'tanggal_kadaluarsa' => $this->faker->dateTimeBetween('now', '+1 year'),
            'diskon' => $this->faker->randomFloat(0, 1000, 7000),
        ];
    }
}
