<?php

namespace Database\Seeders;

use App\Models\voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        voucher::factory()->count(3)->create();
    }
}
