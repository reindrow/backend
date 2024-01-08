<?php

namespace Database\Factories;

use App\Models\pembelian;
use App\Models\produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembelianItem>
 */
class PembelianItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomProduct = Produk::inRandomOrder()->first(); // Ambil produk secara acak
        $kuantitas = $this->faker->numberBetween(1, 10); // Menghasilkan kuantitas secara acak
        $idpembelian = pembelian::pluck('id_pembelian')->toArray(); // Mendapatkan daftar ID dari tabel user
        $randomPembelianId = count($idpembelian) > 0 ? $this->faker->randomElement($idpembelian) : null;

        return [
            'id_produk' => $randomProduct->id_produk,
            'kuantitas' => $kuantitas,
            'total_harga' => $randomProduct->harga * $kuantitas,
            'id_pembelian'=> $randomPembelianId
        ];
    }
}
