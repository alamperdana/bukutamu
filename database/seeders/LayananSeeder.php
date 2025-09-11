<?php

namespace Database\Seeders;

use App\Models\Referensi\Layanan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Layanan::insert([
            [
                'layanan' => 'Pendaftaran dan Verifikasi Akun SPSE',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Konsultasi SPSE',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Konsultasi eKatalog v6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Konsultasi Bela Pengadaan',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Negosiasi Teknis dan Biaya',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Pembuktian Kualifikasi',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Janji Temu',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layanan' => 'Lainnya',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
