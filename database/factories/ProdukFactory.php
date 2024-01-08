<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(2),
            'harga' => $this->faker->randomFloat(0, 23000, 9999),
            'stok'=>$this->faker->numberBetween(1, 100), 
        ];
    }
}
