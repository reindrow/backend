<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembelian>
 */
class PembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::pluck('id_user')->toArray(); // Mendapatkan daftar ID dari tabel user
        $randomUserId = $this->faker->randomElement($users); // Pilih secara acak ID user

        return [
            'id_user' => $randomUserId,
            'tanggal_pembelian' => $this->faker->date(),
        ];
    }
}
