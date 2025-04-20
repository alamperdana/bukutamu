<?php

namespace Database\Seeders;

use App\Models\Tahun;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Tahun::create(['tahun' => '2024', 'created_at' => $now, 'updated_at' => $now]);
        Tahun::create(['tahun' => '2025', 'created_at' => $now, 'updated_at' => $now]);
    }
}
