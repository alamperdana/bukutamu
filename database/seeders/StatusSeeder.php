<?php

namespace Database\Seeders;

use App\Models\Referensi\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Status::insert([
            [
                'status' => 'Pending',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status' => 'Dalam Pelayanan',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status' => 'Eskalasi Atasan',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status' => 'Eskalasi LKPP',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status' => 'Selesai',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
