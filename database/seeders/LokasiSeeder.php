<?php

namespace Database\Seeders;

use App\Models\lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        lokasi::factory()->count(3)->create();
    }
}
