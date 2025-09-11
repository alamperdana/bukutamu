<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SubKegiatan;
use App\Models\Transport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class, // Referensi
            UserSeeder::class, // Referensi
            MenuSeeder::class, // Referensi
            TahunSeeder::class, // Referensi
            LayananSeeder::class, // Referensi
            LokasiLayananSeeder::class, // Referensi
            StatusSeeder::class, // Referensi
            RoleHasPermissionSeeder::class,
        ]);
    }
}
