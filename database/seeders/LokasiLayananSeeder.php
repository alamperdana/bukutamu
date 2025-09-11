<?php

namespace Database\Seeders;

use App\Models\Referensi\LokasiLayanan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LokasiLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        LokasiLayanan::insert([
            [
                'lokasi_layanan' => 'Kantor LPSE Kota Jambi',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'lokasi_layanan' => 'Konter LPSE Mal Pelayanan Publik Kota Jambi',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
