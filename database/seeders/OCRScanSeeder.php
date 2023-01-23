<?php

namespace Database\Seeders;

use App\Models\OCRScan;
use Illuminate\Database\Seeder;

class OCRScanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OCRScan::factory()->count(10)->create();
    }
}
