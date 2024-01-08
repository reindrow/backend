<?php

namespace Database\Seeders;

use App\Models\pembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pembelian::factory()->count(15)->create();
    }
}
