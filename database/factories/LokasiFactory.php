<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lokasi>
 */
class LokasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'kota' => $this->faker->city(),
            'kodepos'=>$this->faker->numberBetween(100000, 999999), 
        ];
    }
}
