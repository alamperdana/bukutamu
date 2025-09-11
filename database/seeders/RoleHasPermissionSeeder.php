<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $data = [
            ['permission_id' => 20, 'role_id' => 2],
            ['permission_id' => 20, 'role_id' => 3]
        ];

        // Insert data ke tabel role_has_permissions
        DB::table('role_has_permissions')->insert($data);
    }
}
