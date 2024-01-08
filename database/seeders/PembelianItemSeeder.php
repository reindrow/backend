<?php

namespace Database\Seeders;

use App\Models\pembelianitem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pembelianitem::factory()->count(15)->create();
    }
}
