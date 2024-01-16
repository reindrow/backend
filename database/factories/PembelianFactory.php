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

        $users = User::where('id_role', 3)->get(); // Mendapatkan daftar ID dari tabel user
        $randomUserId = $this->faker->randomElement($users); // Pilih secara acak ID user
        $server = User::where('id_role', 2)->get(); // Ambil semua user dengan id_role 2
        $randomServerId = $this->faker->randomElement($server); // Pilih secara acak ID user
    
        return [
            'id_user' => $randomUserId,
            'id_server'=> $randomServerId,
            'tanggal_pembelian' => $this->faker->date(),
        ];
    }
}
