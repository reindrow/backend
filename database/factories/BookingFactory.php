<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Voucher;
use App\Models\user;
use App\Models\lokasi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id_user')->toArray(); // Mendapatkan daftar ID dari tabel user
        $lokasis = Lokasi::pluck('id_lokasi')->toArray(); // Mendapatkan daftar ID dari tabel lokasi
        $vouchers = Voucher::pluck('id_voucher')->toArray(); // Mendapatkan daftar ID dari tabel voucher

        $randomUserId = $this->faker->randomElement($users); // Pilih secara acak ID user
        $randomLokasiId = $this->faker->randomElement($lokasis); // Pilih secara acak ID lokasi
        $randomVoucherId = $this->faker->randomElement($vouchers); // Pilih secara acak ID voucher (jika diperlukan)

        return [
            'id_user' => $randomUserId,
            'id_lokasi' => $randomLokasiId,
            'id_voucher' => $randomVoucherId,
            'tanggal_booking' => $this->faker->dateTimeBetween('+1 day', '+7 days'),
            'status' => $this->faker->randomElement(['request', 'reserved', 'finish']),
        ];
    }
}
