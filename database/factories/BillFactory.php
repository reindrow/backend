<?php

namespace Database\Factories;

use App\Models\booking;
use App\Models\user;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
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
            'ref_id'=>$this->faker->randomElement(['101','202']),
            'ref_type'=>$this->faker->randomNumber(8), 
            'id_user' => $randomUserId,
            'metode_pembayaran'=>$this->faker->randomElement(['Cash', 'E-Wallet']), 
            'status_pembayaran' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),

        ];
    }
}
